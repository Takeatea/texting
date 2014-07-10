<?php

namespace TakeATea\Component\Texting\Manager;

use TakeATea\Component\Texting\Provider\TextingProviderInterface;

class TextingManager implements TextingManagerInterface
{
    /**
     * @var TextingProviderInterface
     */
    protected $provider;

    /**
     * @param TextingProviderInterface $provider
     */
    public function __construct(TextingProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param string $recipient
     * @param string $content
     *
     * @return bool
     */
    public function send($recipient, $content)
    {
        return $this->provider->send($recipient, $content);
    }
}