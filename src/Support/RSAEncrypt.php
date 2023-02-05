<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Support;

/**
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
class RSAEncrypt
{
    /**
     *
     * @var string
     */
    protected $publicKey;

    /**
     *
     * @param  string  $publicKey
     */
    public function __construct(string $publicKey)
    {
        $this->publicKey = $publicKey;
    }

    /**
     *
     * @param  array  $data
     * @return string
     */
    public function encrypt(array $data): string
    {
        $data = json_encode($data);
        openssl_public_encrypt($data, $dataEncrypted, $this->publicKey, OPENSSL_PKCS1_PADDING);

        return base64_encode($dataEncrypted);
    }
}
