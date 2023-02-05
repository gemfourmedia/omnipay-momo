<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

/**
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
abstract class AbstractSignatureRequest extends AbstractRequest
{
    use Concerns\RequestEndpoint;
    use Concerns\RequestSignature;

    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        $parameters = $this->getParameters();

        call_user_func_array(
            [$this, 'validate'],
            $this->getSignatureParameters()
        );
        $parameters['signature'] = $this->generateSignature();
        unset($parameters['secretKey'], $parameters['testMode'], $parameters['publicKey']);

        return $parameters;
    }

    /**
     * @var string
     */
    protected $responseClass;

    /**
     * @return null|string
     */
    public function getOrderId(): ?string
    {
        return $this->getParameter('orderId');
    }

    /**
     * @param  null|string  $id
     * @return $this
     */
    public function setOrderId(?string $id)
    {
        return $this->setParameter('orderId', $id);
    }

    /**
     * @return null|string
     */
    public function getRequestId(): ?string
    {
        return $this->getParameter('requestId');
    }

    /**
     * @param  null|string  $id
     * @return $this
     */
    public function setRequestId(?string $id)
    {
        return $this->setParameter('requestId', $id);
    }

}
