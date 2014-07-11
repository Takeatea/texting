<?php

namespace Takeatea\Component\Texting\Manager;

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
     * @param string $recipient The number to send to
     * @param string $message The message to send to
     * @param string|null $providerName The provider name to use. If none is provided, it should use the first one
     *
     * @return array
     *
     * @throws \InvalidArgumentException if the provider does not exist
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

        return $provider->send($recipient, $message);
    }


}