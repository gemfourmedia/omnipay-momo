<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
abstract class AbstractIncomingRequest extends AbstractRequest
{
    
    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function sendData($data): IncomingResponse
    {
        return $this->response = new IncomingResponse($this, $data);
    }


    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        call_user_func_array(
            [$this, 'validate'],
            array_keys($parameters = $this->getIncomingParameters())
        );

        return $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        
        foreach ($this->getIncomingParameters() as $parameter => $value) {
            $this->setParameter($parameter, $value);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function getIncomingParameters(): array
    {
        $data = [];
        
        // API v2
        $params = [
            'partnerCode', 'orderId', 'requestId', 'amount', 'orderInfo', 'orderType', 'transId', 
            'resultCode', 'message', 'payType', 'responseTime', 'extraData', 'signature',
        ];
        
        $bag = $this->getIncomingParametersBag();

        foreach ($params as $param) {
            $data[$param] = $bag->get($param);
        }

        return $data;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\ParameterBag
     */
    abstract protected function getIncomingParametersBag(): ParameterBag;
}
