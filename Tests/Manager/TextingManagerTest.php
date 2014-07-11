<?php

namespace Takeatea\Component\Texting\Tests\Manager;

use Takeatea\Component\Texting\Manager\TextingManager;

class TextintManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $provider;

    /***
     * @var TextingManager
     */
    protected $manager;

    protected function setUp()
    {
        $this->provider = $this->getMock('Takeatea\Component\Texting\Provider\TextingProviderInterface');
        $this->manager = new TextingManager();
    }

    public function testRegisterProvider()
    {
        $this->provider->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('provider-test'));

        $this->manager->registerProvider($this->provider);
        $providersList = $this->manager->getProviders();

        $this->assertArrayHasKey('provider-test', $providersList);
        $this->assertEquals($this->provider, $providersList['provider-test']);
    }

    public function testSendDefaultProvider()
    {
        $this->provider->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('provider-test'));
        $this->provider->expects($this->once())
            ->method('send');
        $provider2 = $this->getMock('Takeatea\Component\Texting\Provider\TextingProviderInterface');
        $provider2->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('noway-provider'));
        $provider2->expects($this->never())
            ->method('send');

        $this->manager->registerProvider($this->provider);
        $this->manager->registerProvider($provider2);
        $this->manager->send('0101010101', 'Te(x|s)ting message');
    }

    public function testSendInvalidProvider()
    {
        $this->provider->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('provider-test'));

        $this->manager->registerProvider($this->provider);

        $this->setExpectedException('\InvalidArgumentException');
        $this->manager->send('0101010101', 'Te(x|s)ting message', 'noway-provider');
    }

    public function testSendSpecificProvider()
    {
        $this->provider->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('provider-test'));
        $this->provider->expects($this->never())
            ->method('send');
        $provider2 = $this->getMock('Takeatea\Component\Texting\Provider\TextingProviderInterface');
        $provider2->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('noway-provider'));
        $provider2->expects($this->once())
            ->method('send');

        $this->manager->registerProvider($this->provider);
        $this->manager->registerProvider($provider2);

        $this->manager->send('0101010101', 'Te(x|s)ting message', 'noway-provider');
    }
}