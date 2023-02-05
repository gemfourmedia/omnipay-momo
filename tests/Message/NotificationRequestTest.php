<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\NotificationRequest;

/**
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
class NotificationRequestTest extends TestCase
{
    /**
     * @var NotificationRequest
     */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $params = [
            'partnerCode',
            'orderId',
            'requestId',
            'amount',
            'orderInfo',
            'orderType',
            'transId',
            'resultCode',
            'message',
            'payType',
            'responseTime',
            'extraData',
            'signature',
        ];
        $request->initialize([], array_combine($params, range(1, 13)));
        $this->request = new NotificationRequest($client, $request);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertEquals(13, count($data));
        $this->assertEquals(1, $data['partnerCode']);
        $this->assertEquals(2, $data['orderId']);
        $this->assertEquals(3, $data['requestId']);
        $this->assertEquals(4, $data['amount']);
        $this->assertEquals(5, $data['orderInfo']);
        $this->assertEquals(6, $data['orderType']);
        $this->assertEquals(7, $data['transId']);
        $this->assertEquals(8, $data['resultCode']);
        $this->assertEquals(9, $data['message']);
        $this->assertEquals(10, $data['payType']);
        $this->assertEquals(11, $data['responseTime']);
        $this->assertEquals(12, $data['extraData']);
        $this->assertEquals(13, $data['signature']);
    }
}
