<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

use Omnipay\MoMo\Support\Arr;
use Omnipay\MoMo\Concerns\Parameters;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    use Parameters;

    /**
     * {@inheritdoc}
     */
    public function validate(...$parameters): void
    {
        $listParameters = $this->getParameters();

        foreach ($parameters as $parameter) {
            if (null === Arr::getValue($parameter, $listParameters)) {
                throw new InvalidRequestException(sprintf('The `%s` parameter is required', $parameter));
            }
        }
    }
}
