<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @link https://developers.momo.vn/v3/docs/payment/api/result-handling/notification
 *
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
class NotificationRequest extends AbstractIncomingRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getIncomingParametersBag(): ParameterBag
    {
        if (0 === strpos($this->httpRequest->headers->get('Content-Type'), 'application/json')) {
        	return new ParameterBag(json_decode($this->httpRequest->getContent(), true));
    	}
    	return $this->httpRequest->request;
    }

}
