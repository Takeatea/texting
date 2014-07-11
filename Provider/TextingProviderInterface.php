<?php

namespace Takeatea\Component\Texting\Provider;

interface TextingProviderInterface
{
    /**
     * Will return the provider. Ensure to make it unique
     *
     * @return string
     */
    public function getName();

    /**
     * Will perform the message send. Will return anyhow an array with the response
     *
     * @param string $recipient
     * @param string $message
     *
     * @return array
     */
    public function send($recipient, $message);
}