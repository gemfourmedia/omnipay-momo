<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

/**
 * @link https://developers.momo.vn/v3/docs/payment/api/payment-api/refund
 *
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
class RefundRequest extends AbstractSignatureRequest
{
    /**
     * {@inheritdoc}
     */
    protected $responseClass = RefundResponse::class;

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);

        $this->setParameter('description', $this->getDescription() ?? '');
        $this->setParameter('lang', $this->getParameter('lang') ?? 'vi');

        return $this;
    }

        /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function sendData($data)
    {
        $response = $this->httpClient->request('POST', $this->getEndpoint().'/v2/gateway/api/refund', [
            'Content-Type' => 'application/json; charset=UTF-8',
        ], json_encode($data));

        $responseClass = $this->responseClass;
        $responseData = $response->getBody()->getContents();

        return $this->response = new $responseClass($this, json_decode($responseData, true) ?? []);
    }

    /**
     * {@inheritdoc}
     */
    public function getTransactionId(): ?string
    {
        return $this->getTransId();
    }

    /**
     * {@inheritdoc}
     */
    public function setTransactionId($value)
    {
        return $this->setTransId($value);
    }

    /**
     * Trả về mã giao dịch của MoMo.
     *
     * @return null|string
     */
    public function getTransId(): ?string
    {
        return $this->getParameter('transId');
    }

    /**
     * @param  null|string  $id
     * @return $this
     */
    public function setTransId(?string $id)
    {
        return $this->setParameter('transId', $id);
    }


    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        return [
            'accessKey', 'amount', 'description', 'orderId', 'partnerCode', 'requestId', 'transId',
        ];
    }
}
