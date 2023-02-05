<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\Concerns;

/**
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
trait RequestEndpoint
{
    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        return $this->getTestMode() ? 'https://test-payment.momo.vn' : 'https://payment.momo.vn';
    }
}
