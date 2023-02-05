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
class Signature
{
    /**
     *
     * @var string
     */
    protected $secretKey;

    /**
     *
     * @param  string  $secretKey
     */
    public function __construct(string $secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * Generate hmac 256 signature.
     *
     * @param  array  $data
     * @return string
     */
    public function generate(array $data): string
    {
        $data = urldecode(http_build_query($data));

        return hash_hmac('sha256', $data, $this->secretKey);
    }

    /**
     * Signature validation.
     *
     * @param  array  $data
     * @param  string  $expect
     * @return bool
     */
    public function validate(array $data, string $expect): bool
    {
        $actual = $this->generate($data);

        return 0 === strcasecmp($expect, $actual);
    }
}
