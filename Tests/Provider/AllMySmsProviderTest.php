<?php

namespace Takeatea\Component\Texting\Tests\Provider;

use Takeatea\Component\Texting\Provider\AllMySmsProvider;

class AllMySmsProviderTest extends \PHPUnit_Framework_TestCase
{
    protected $httpClient;

    /**
     * @var AllMySmsProvider
     */
    protected $provider;

    protected function setUp()
    {
        $this->httpClient = $this->getMockBuilder('GuzzleHttp\Client')->disableOriginalConstructor()->getMock();

        $this->provider = new AllMySmsProvider('login', 'password', $this->httpClient);
    }

    public function testGetName()
    {
        $this->assertEquals('all_my_sms', $this->provider->getName());
    }

    public function testSend()
    {
        //$this->provider->send('0101010101', 'te(x|s)ting message');
    }
}