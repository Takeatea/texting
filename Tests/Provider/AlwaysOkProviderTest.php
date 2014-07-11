<?php

namespace Takeatea\Component\Texting\Tests\Provider;

use Takeatea\Component\Texting\Provider\AlwaysOkProvider;

class AlwaysOkProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AlwaysOkProvider
     */
    protected $provider;

    public function testGetName()
    {
        $this->assertEquals('__always_ok', $this->provider->getName());
    }

    public function testGetResponse()
    {
        $this->assertEquals(array(), $this->provider->getResponse('dummy', 'test'));
    }

    public function testIsResponseValid()
    {
        $this->assertTrue($this->provider->isResponseValid(array()));
    }

    protected function setUp()
    {
        $this->provider = new AlwaysOkProvider();
    }
}