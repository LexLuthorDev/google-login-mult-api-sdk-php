<?php

namespace GoogleLoginSDK;

class GoogleLogin
{
    private $oauthClient;

    public function __construct($clientId, $clientSecret, $redirectUri)
    {
        $this->oauthClient = new OAuthClient($clientId, $clientSecret, $redirectUri);
    }

    public function getLoginUrl()
    {
        return $this->oauthClient->getAuthUrl();
    }

    public function getUserInfo($code)
    {
        $client = $this->oauthClient->getClient();
        $token = $this->oauthClient->authenticate($code);

        // Verifica o token de ID
        $payload = $client->verifyIdToken();

        if (!$payload) {
            throw new \Exception('ID Token verification failed.');
        }

        return [
            'accessToken' => $token['access_token'],
            'idToken' => $token['id_token'],
            'user' => [
                'id' => $payload['sub'],
                'email' => $payload['email'],
                'name' => $payload['name'],
                'picture' => $payload['picture'],
            ],
        ];
    }
}
