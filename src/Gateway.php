<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo;

use Omnipay\Common\AbstractGateway;
use Omnipay\MoMo\Message\PurchaseRequest;
use Omnipay\MoMo\Message\CompletePurchaseRequest;
use Omnipay\MoMo\Message\NotificationRequest;
use Omnipay\MoMo\Message\QueryTransactionRequest;
use Omnipay\MoMo\Message\RefundRequest;
use Omnipay\MoMo\Message\QueryRefundRequest;

/**
 * @link https://developers.momo.vn/v3/vi/docs/payment/api/wallet/onetime
 *
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
class Gateway extends AbstractGateway
{
    use Concerns\Parameters;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'MoMo';
    }

    /**
     * Request payment from MoMo
     * 
     * @param  array  $options
     * @return \Omnipay\Common\Message\RequestInterface|PurchaseRequest
     */
    public function purchase(array $options = []): PurchaseRequest
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * Complete payment after momo redirect back
     * 
     * @param  array  $options
     * @return \Omnipay\Common\Message\RequestInterface|CompletePurchaseRequest
     */
    public function completePurchase(array $options = []): CompletePurchaseRequest
    {
        return $this->createRequest(CompletePurchaseRequest::class, $options);
    }

    /**
     * Momo IPN handle
     *
     * @param  array  $options
     * @return \Omnipay\Common\Message\RequestInterface|NotificationRequest
     */
    public function notification(array $options = []): NotificationRequest
    {
        return $this->createRequest(NotificationRequest::class, $options);
    }

    /**
     * Query transaction
     *
     * @param  array  $options
     * @return \Omnipay\Common\Message\RequestInterface|QueryTransactionRequest
     */
    public function queryTransaction(array $options = []): QueryTransactionRequest
    {
        return $this->createRequest(QueryTransactionRequest::class, $options);
    }

    /**
     * Request Refund
     * 
     * @param  array  $options
     * @return \Omnipay\Common\Message\RequestInterface|RefundRequest
     */
    public function refund(array $options = [])
    {
        return $this->createRequest(RefundRequest::class, $options);
    }

    /**
     * Query refund
     * 
     * @param  array  $options
     * @return \Omnipay\Common\Message\RequestInterface|QueryRefundRequest
     */
    public function queryRefund(array $options = [])
    {
        return $this->createRequest(QueryRefundRequest::class, $options);
    }
}
