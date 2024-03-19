<?php

namespace Orata\Bundle\PayboxBundle\Tests\Transport;

use Orata\Bundle\PayboxBundle\Paybox\RequestInterface;
use Orata\Bundle\PayboxBundle\Paybox\System\Cancellation\Request;
use Orata\Bundle\PayboxBundle\Transport\CurlTransport;

/**
 * Test class for CurlTransport
 */
class CurlTransportTest extends \PHPUnit\Framework\TestCase
{
    protected $object;

    protected $globals;

    protected $server;

    public function setUp(): void
    {
        if (!function_exists('curl_init')) {
            $this->markTestSkipped('cURL is not available. Activate it first.');
        }

        $this->object = new CurlTransport();

        $this->server = array('system' => array('protocol' => 'http', 'host' => 'test.com', 'cancellation_path' => 'test.cgi'));
        $this->globals = array('currencies' => array(), 'site' => '052', 'rank' => '032', 'login' => '12345679', 'hmac' => array('key' => '123123133', 'algorithm' => 'sha512', 'signature_name' => 'Sign'));
    }

    public function testCall()
    {
        $this->expectException(\RuntimeException::class);
        $this->object->setEndpoint('http://www.google.com/hey.cgi');
        $method = new \ReflectionMethod('\Orata\Bundle\PayboxBundle\Transport\CurlTransport', 'call');

        $cancellationRequest = new Request($this->globals, $this->server, $this->object);
        $cancellationRequest->setParameter('HMAC', 'test');
        $cancellationRequest->setParameter('TIME', 'test');

        $response = $method->invoke($this->object, $cancellationRequest);

        $this->assertTrue(is_string($response));
    }

    public function testCallEmpty()
    {
        $curl = new mockCurlTransport();

        $this->assertEquals($curl->call(new Request($this->globals, $this->server, $this->object)), '');
    }

}

class mockCurlTransport extends CurlTransport
{
    public function call(RequestInterface $request)
    {
        return '';
    }
}
