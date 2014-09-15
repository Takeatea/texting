<?php

namespace Takeatea\Component\Texting\Manager;

use Takeatea\Component\Texting\Exception\SendingException;
use Takeatea\Component\Texting\Provider\TextingProviderInterface;

abstract class AbstractTextingManager implements TextingManagerInterface
{
    /**
     * @var array
     */
    protected $providers;

    /**
     * @var TextingProviderInterface
     */
    protected $defaultProvider;

    /**
     * Will register the provider to be used later on.
     *
     * @param TextingProviderInterface $provider
     */
    public function registerProvider(TextingProviderInterface $provider)
    {
        if (!$this->defaultProvider) {
            $this->defaultProvider = &$provider;
        }

        $this->providers[$provider->getName()] = $provider;
    }

    /**
     * Will return the list of registered providers
     *
     * @return array
     */
    public function getProviders()
    {
        return $this->providers;
    }

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
    public function send($recipient, $message, $providerName = null)
    {
        if (!$providerName) {
            $provider = $this->defaultProvider;
        }
        elseif (!isset($this->providers[$providerName])) {
            throw new \InvalidArgumentException(sprintf('The provider named "%s" does not exist. Registered providers are : "%s"', $providerName, implode('", "', array_keys($this->providers))));
        }
        else {
            $provider = $this->providers[$providerName];
        }

        $response = $provider->getResponse($recipient, $message);

        if (!$provider->isResponseValid($response)) {
            throw new SendingException(sprintf('Invalid response : %s', json_encode($response)));
        }
    }
}
