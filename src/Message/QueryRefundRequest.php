<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

/**
 * @link https://developers.momo.vn/v3/docs/payment/api/payment-api/refund#query-refund-result
 *
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
class QueryRefundRequest extends AbstractSignatureRequest
{
    /**
     * {@inheritdoc}
     */
    protected $responseClass = QueryRefundResponse::class;

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        $this->setParameter('lang', $this->getParameter('lang') ?? 'vi');
        
        return $this;
    }

        /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function sendData($data)
    {
        // unset($data['accessKey']);

        $response = $this->httpClient->request('POST', $this->getEndpoint().'/v2/gateway/api/refund/query', [
            'Content-Type' => 'application/json; charset=UTF-8',
        ], json_encode($data));

        $responseClass = $this->responseClass;
        $responseData = $response->getBody()->getContents();

        return $this->response = new $responseClass($this, json_decode($responseData, true) ?? []);
    }

    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        return [
            'accessKey', 'orderId', 'partnerCode', 'requestId'
        ];
    }
}
