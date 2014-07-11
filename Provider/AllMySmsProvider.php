<?php

namespace Takeatea\Component\Texting\Provider;

use GuzzleHttp\Client;

class AllMySmsProvider implements TextingProviderInterface
{
    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var
     */
    protected $httpClient;

    /**
     * @param string $login
     * @param string $password
     * @param \GuzzleHttp\Client $httpClient
     */
    public function __construct($login, $password, Client $httpClient)
    {
        $this->login = $login;
        $this->password = $password;
        $this->httpClient = $httpClient;
    }

    /**
     * Will return the provider. Ensure to make it unique
     *
     * @return string
     */
    public function getName()
    {
        return 'all_my_sms';
    }

    /**
     * Will perform the message send. Will return anyhow an array with the response
     *
     * @param string $recipient
     * @param string $message
     *
     * @return array
     */
    public function send($recipient, $message)
    {
        die('ok');
    }
}