<?php

namespace GoogleLoginSDK;

use Google\Client;

class OAuthClient
{
    private $client;

    public function __construct($clientId, $clientSecret, $redirectUri)
    {
        $this->client = new Client();
        $this->client->setClientId($clientId);
        $this->client->setClientSecret($clientSecret);
        $this->client->setRedirectUri($redirectUri);
        $this->client->addScope(['profile', 'email']);
    }

    public function getAuthUrl()
    {
        return $this->client->createAuthUrl();
    }

    public function authenticate($code)
    {
        $token = $this->client->fetchAccessTokenWithAuthCode($code);
        $this->client->setAccessToken($token);

        return $token;
    }

    public function getClient()
    {
        return $this->client;
    }
}
