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
    public function getResponse($recipient, $message)
    {
        $message = json_encode(array(
            'message' => urlencode($message),
            'sms' => array($recipient)
        ));

        $fields = array(
            'clientcode'    => urlencode($this->login),
            'passcode'      => urlencode($this->password),
            'smsData'       => urlencode($message),
        );

        $fieldsString = '';

        foreach($fields as $key => $value) {
            $fieldsString .= $key.'='.$value.'&';
        }

        rtrim($fieldsString, '&');

        $response = $this->httpClient->post('http://api.msinnovations.com/http/sendSms_v8.php', array(
            'body' => $fieldsString
        ));

        return $response->json();
    }

    /**
     * Will check if the SMS has been sent correctly
     *
     * @param mixed $response
     *
     * @return bool
     */
    public function isResponseValid($response)
    {
        return 100 === $response['status'];
    }
}