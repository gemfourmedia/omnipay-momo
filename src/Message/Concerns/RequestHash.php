<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

 namespace Omnipay\MoMo\Message\Concerns;

use Omnipay\MoMo\Support\Arr;
use Omnipay\MoMo\Support\RSAEncrypt;

/**
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
trait RequestHash
{
    /**
     * @return string
     */
    protected function generateHash(): string
    {
        $data = [];
        $rsa = new RSAEncrypt(
            $this->getPublicKey()
        );
        $parameters = $this->getParameters();

        foreach ($this->getHashParameters() as $pos => $parameter) {
            if (! is_string($pos)) {
                $pos = $parameter;
            }

            $data[$pos] = Arr::getValue($parameter, $parameters);
        }

        return $rsa->encrypt($data);
    }

    /**
     * @return array
     */
    abstract protected function getHashParameters(): array;
}
