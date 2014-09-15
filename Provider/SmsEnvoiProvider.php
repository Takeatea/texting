<?php

namespace Takeatea\Component\Texting\Provider;

use GuzzleHttp\Client;

class SmsEnvoiProvider implements TextingProviderInterface
{
    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $messageOptions = array(
        'type' => 'sms',
        'subtype' => 'PREMIUM'
    );

    /**
     * @param string $email
     * @param string $apiKey
     * @param Client $httpClient
     * @param array $messageOptions
     */
    public function __construct($email, $apiKey, Client $httpClient, $messageOptions = array())
    {
        $this->email = $email;
        $this->apiKey = $apiKey;
        $this->httpClient = $httpClient;

        if (count($messageOptions)) {
            $this->messageOptions = array_merge($this->messageOptions, $messageOptions);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sms_envoi';
    }

    /**
     * {@inheritdoc}
     */
    public function getResponse($recipient, $message)
    {
        $data = array(
            'email' => $this->email,
            'apikey' => $this->apiKey
        );

        foreach ($this->messageOptions as $name => $value) {
            $data[sprintf('message[%s]', $name)] = $value;
        }

        $data['message[recipients]'] = $recipient;
        $data['message[content]'] = $message;

        $data = http_build_query($data);

        $response = $this->httpClient->post('http://www.smsenvoi.com/httpapi/sendsms/', array(
            'headers' => array(
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Content-Length' => strlen($data)
            ),
            'body' => $data
        ));

        return $response->json();
    }

    /**
     * {@inheritdoc}
     */
    public function isResponseValid($response)
    {
        return isset($response['success']) && 1 == $response['success'];
    }
}
