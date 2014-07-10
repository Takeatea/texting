<?php

namespace TakeATea\Component\Texting\Manager;

interface TextingManagerInterface
{
    /**
     * @param string $recipient
     * @param string $content
     *
     * @return bool
     */
    public function send($recipient, $content);
}