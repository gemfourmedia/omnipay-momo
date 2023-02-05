<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

use Omnipay\Common\Message\RequestInterface;

/**
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
abstract class AbstractSignatureResponse extends AbstractResponse
{
    use Concerns\ResponseSignatureValidation;

    /**
     *
     * @param  \Omnipay\Common\Message\RequestInterface  $request
     * @param $data
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);

        if ('0' === $this->getResultCode()) {
            $this->validateSignature();
        }
    }

}
