<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

/**
 * @link https://developers.momo.vn/v3/docs/payment/api/wallet/onetime#initiate-payment-method
 *
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
class PurchaseRequest extends AbstractSignatureRequest
{
    /**
     * {@inheritdoc}
     */
    protected $responseClass = PurchaseResponse::class;

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        $this->setOrderInfo($this->getParameter('orderInfo') ?? '');
        $this->setExtraData($this->getParameter('extraData') ?? '');
        
        // Momo API V3
        $this->setParameter('requestType', $this->getParameter('requestType') ?? 'captureWallet');
        $this->setRedirectUrl($this->getParameter('redirectUrl') ?? '');
        $this->setIpnUrl($this->getParameter('ipnUrl') ?? '');
        $this->setLang($this->getParameter('lang') ?? '');


        return $this;
    }

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function sendData($data)
    {

        $response = $this->httpClient->request('POST', $this->getEndpoint().'/v2/gateway/api/create', [
            'Content-Type' => 'application/json; charset=UTF-8',
        ], json_encode($data));

        $responseClass = $this->responseClass;
        $responseData = $response->getBody()->getContents();

        return $this->response = new $responseClass($this, json_decode($responseData, true) ?? []);
    }

    /**
     * @return null|string
     */
    public function getExtraData(): ?string
    {
        return $this->getParameter('extraData');
    }

    /**
     * @param  null|string  $data
     * @return $this
     */
    public function setExtraData(?string $data)
    {
        return $this->setParameter('extraData', $data);
    }

    /**
     *
     * @return null|string
     */
    public function getOrderInfo(): ?string
    {
        return $this->getParameter('orderInfo');
    }

    /**
     * @param  null|string  $info
     * @return $this
     */
    public function setOrderInfo(?string $info)
    {
        return $this->setParameter('orderInfo', $info);
    }

    public function getRedirectUrl(): ?string
    {
        return $this->getParameter('redirectUrl');
    }

    public function setRedirectUrl(?string $url)
    {
        return $this->setParameter('redirectUrl', $url);
    }

    public function getIpnUrl(): ?string
    {
        return $this->getParameter('ipnUrl');
    }

    public function setIpnUrl(?string $url)
    {
        return $this->setParameter('ipnUrl', $url);
    }

    public function getLang(): ?string
    {
        return $this->getParameter('lang');
    }

    public function setLang(?string $lang)
    {
        return $this->setParameter('lang', $lang);
    }

    public function getRequestType(): ?string
    {
        return $this->getParameter('requestType');
    }

    /**
     * Available requestType:
     * captureWallet: Payment by using Momo Wallent
     * payWithATM: Payment by using Local ATM
     * payWithCC: Payment by using Credit Card (visa/master/...)
     */
    public function setRequestType(?string $type)
    {
        return $this->setParameter('requestType', $type);
    }

    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        return [
            'accessKey', 'amount', 'extraData', 'ipnUrl', 'orderId', 'orderInfo', 'partnerCode', 'redirectUrl',
            'requestId', 'requestType',
        ];

    }
}