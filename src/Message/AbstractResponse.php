<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;

/**
 * @method AbstractRequest getRequest()
 *
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
abstract class AbstractResponse extends BaseAbstractResponse
{
    use Concerns\ResponseProperties;

    /**
     * {@inheritdoc}
     */
    public function isSuccessful(): bool
    {
        return '0' === $this->getResultCode();
    }

    /**
     * {@inheritdoc}
     */
    public function isCancelled(): bool
    {
        return '49' === $this->getResultCode();
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage(): ?string
    {
        return $this->data['message'] ?? null;
    }
    
    /**
     * Transaction ID
     *
     * @return null|string
     */
    public function getTransactionId(): ?string
    {
        return $this->data['orderId'] ?? null;
    }

    /**
     * Transaction reference.
     *
     * @return null|string
     */
    public function getTransactionReference(): ?string
    {
        return $this->data['transId'] ?? null;
    }

    /**
     * Result code from MoMo.
     * 0 mean success.
     *
     * @return null|string
     */
    public function getResultCode(): ?string
    {
        return $this->data['resultCode'] ?? null;
    }

}
