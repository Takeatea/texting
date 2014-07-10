<?php

namespace TakeATea\Component\Texting\Provider;

class AllMySmsProvider implements TextingProviderInterface
{
    public function __construct($login, $password)
    {

    }

    /**
     * @param string $recipient
     * @param string $content
     *
     * @return mixed
     */
    public function send($recipient, $content)
    {
        // TODO: Implement send() method.
    }
}