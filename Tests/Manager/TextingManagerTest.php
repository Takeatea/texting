<?php

namespace TakeATea\Component\Texting\Tests;

use TakeATea\Component\Texting\Manager\TextingManager;

class TextingManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $provider;

    /**
     * @var TextingManager
     */
    protected $manager;

    protected function setUp()
    {
        $this->provider = $this->getMockBuilder('TakeATea\Component\Texting\Provider\TextingProviderInterface')->disableOriginalConstructor()->getMock();

        $this->manager = new TextingManager($this->provider);
    }

    public function testSend()
    {
        $this->provider->expects($this->once())
            ->method('send')
            ->with($this->equalTo('0606060606'));

        $this->manager->send('0606060606', 'Test message');
    }
}