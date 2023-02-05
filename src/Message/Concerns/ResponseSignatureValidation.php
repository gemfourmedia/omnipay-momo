<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

 namespace Omnipay\MoMo\Message\Concerns;

use Omnipay\MoMo\Support\Arr;
use Omnipay\MoMo\Support\Signature;
use Omnipay\Common\Exception\InvalidResponseException;

/**
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
trait ResponseSignatureValidation
{
    /**
     * Validate Signature from Momo Response
     *
     * @throws InvalidResponseException
     */
    protected function validateSignature(): void
    {
        $data = $this->getData();

        if (! isset($data['signature'])) {
            throw new InvalidResponseException(sprintf('Response from MoMo is invalid!'));
        }

        $dataSignature = [];
        $signature = new Signature(
            $this->getRequest()->getSecretKey()
        );

        foreach ($this->getSignatureParameters() as $pos => $parameter) {
            if (! is_string($pos)) {
                $pos = $parameter;
            }
            
            $dataSignature[$pos] = Arr::getValue($parameter, $data);
        }
        
        $dataSignature['accessKey'] = $dataSignature['accessKey'] ?? $this->getRequest()->getAccessKey();

        if (! $signature->validate($dataSignature, $data['signature'])) {
            throw new InvalidResponseException(sprintf('Data signature response from MoMo is invalid!'));
        }
    }

    /**
     * Array of parameters use for generate hmac signature.
     *
     * @return array
     */
    abstract protected function getSignatureParameters(): array;
}
