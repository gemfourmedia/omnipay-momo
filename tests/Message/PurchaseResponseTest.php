<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\PurchaseResponse;

/**
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
class PurchaseResponseTest extends TestCase
{
    public function testConstruct()
    {
        $response = new PurchaseResponse($this->getMockRequest(), [
            'example' => 'value',
            'foo' => 'bar',
        ]);

        $this->assertEquals(['example' => 'value', 'foo' => 'bar'], $response->getData());
    }

    public function testPurchaseSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseSuccess.txt');
        $request = $this->getMockRequest();
        $request->shouldReceive('getSecretKey')->once()->andReturn('fj00YKnJhmYqahaFWUgkg75saNTzMrbO');
        $response = new PurchaseResponse(
            $request,
            json_decode($httpResponse->getBody()->getContents(), true)
        );

        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isSuccessful());
        $this->assertSame('MM1540456472575', $response->getTransactionId());
        $this->assertTrue($response->isRedirect());
        $this->assertSame('GET', $response->getRedirectMethod());
    }

    public function testPurchaseFailure()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseFailure.txt');
        $response = new PurchaseResponse(
            $this->getMockRequest(),
            json_decode($httpResponse->getBody()->getContents(), true)
        );

        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Amount invalid should be between 1,000đ and 20,000,000đ', $response->getMessage());
    }
}
