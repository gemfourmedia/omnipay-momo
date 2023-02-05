<?php
/**
 * @link https://github.com/gemfourmedia/omnipay-momo
 * @copyright (c) Gem Four Media
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\IncomingResponse;

/**
 * @author Sang Dang <sangdang@gemfourmedia.com>
 * @since 1.0.0
 */
class IncomingResponseTest extends TestCase
{
    public function testConstruct()
    {
        // response should decode URL format data
        $response = new IncomingResponse($this->getMockRequest(), [
            'example' => 'value',
            'foo' => 'bar',
        ]);

        $this->assertEquals(['example' => 'value', 'foo' => 'bar'], $response->getData());
    }

    public function testResponse()
    {
        $request = $this->getMockRequest();
        $response = new IncomingResponse(
            $request,
            [
                'test' => 321,
            ]
        );

        $this->assertSame(321, $response->test);
    }
}
