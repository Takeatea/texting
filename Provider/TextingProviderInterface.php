<?php

namespace TakeATea\Component\Texting\Provider;

interface TextingProviderInterface
{
    /**
     * @param string $recipient
     * @param string $content
     *
     * @return mixed
     */
    public function send($recipient, $content);
}