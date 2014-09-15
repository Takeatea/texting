<?php

namespace Takeatea\Component\Texting\Manager;

use Takeatea\Component\Texting\Provider\TextingProviderInterface;

interface TextingManagerInterface
{
    /**
     * Will register the provider to be used later on.
     *
     * @param TextingProviderInterface $provider
     */
    public function registerProvider(TextingProviderInterface $provider);

    /**
     * Will return the list of registered providers
     *
     * @return array
     */
    public function getProviders();

    /**
     * @param string $recipient The number to send to
     * @param string $message The message to send to
     * @param string|null $providerName The provider name to use. If none is provided, it should use the first one
     *
     * @throws \InvalidArgumentException if the provider does not exist
     * @throws \Takeatea\Component\Texting\Exception\SendingException if an error occured while sending the SMS
     *
     * @see TextingProviderInterface::isValid()
     */
    public function send($recipient, $message, $providerName = null);
}
