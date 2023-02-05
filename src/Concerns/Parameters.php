<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Concerns;

/**
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
trait Parameters
{
    /**
     *
     * @return null|string
     */
    public function getAccessKey(): ?string
    {
        return $this->getParameter('accessKey');
    }

    /**
     *
     * @param  null|string  $key
     * @return $this
     */
    public function setAccessKey(?string $key)
    {
        return $this->setParameter('accessKey', $key);
    }

    /**
     *
     * @return null|string
     */
    public function getSecretKey(): ?string
    {
        return $this->getParameter('secretKey');
    }

    /**
     *
     * @param  null|string  $key
     * @return $this
     */
    public function setSecretKey(?string $key)
    {
        return $this->setParameter('secretKey', $key);
    }

    /**
     *
     * @return null|string
     */
    public function getPartnerCode(): ?string
    {
        return $this->getParameter('partnerCode');
    }

    /**
     * Thiết lập partner code do MoMo cấp.
     *
     * @param  null|string  $code
     * @return $this
     */
    public function setPartnerCode(?string $code)
    {
        return $this->setParameter('partnerCode', $code);
    }

    /**
     * Trả về public key do MoMo cấp.
     *
     * @return null|string
     */
    public function getPublicKey(): ?string
    {
        return $this->getParameter('publicKey');
    }

    /**
     * Thiết lập public key do MoMo cấp.
     *
     * @param  null|string  $key
     * @return $this
     */
    public function setPublicKey(?string $key)
    {
        return $this->setParameter('publicKey', $key);
    }
}
