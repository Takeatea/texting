<?php

namespace Takeatea\Component\Texting\Tests\Provider;

use Takeatea\Component\Texting\Provider\AlwaysKoProvider;

class AlwaysKoProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AlwaysKoProvider
     */
    protected $provider;

    public function testGetName()
    {
        $this->assertEquals('__always_ko', $this->provider->getName());
    }

    public function testGetResponse()
    {
        $this->assertEquals(array(), $this->provider->getResponse('dummy', 'test'));
    }

    public function testIsResponseValid()
    {
        $this->assertFalse($this->provider->isResponseValid(array()));
    }

    protected function setUp()
    {
        $this->provider = new AlwaysKoProvider();
    }
}