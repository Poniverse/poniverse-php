<?php

namespace Poniverse\Lib;

use GuzzleHttp\Client as HttpClient;
use League\OAuth2\Client\Token\AccessToken;
use Poniverse\Lib\OAuth2\PoniverseProvider;

class Client
{
    /**
     * @var string|null
     */
    protected $accessToken = null;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * Poniverse.net Client ID.
     *
     * @var string
     */
    private $clientId;

    /**
     * Poniverse.net Client Secret.
     *
     * @var string
     */
    private $clientSecret;

    protected $poniverseUrl = 'http://api.poniverse.local';
    protected $ponyfmUrl = 'https://pony.fm';

    /**
     * Initializes the Poniverse Api client.
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param \GuzzleHttp\Client $httpClient
     */
    public function __construct($clientId, $clientSecret, HttpClient $httpClient)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->httpClient = $httpClient;
    }

    /**
     * Returns the set access key.
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Sets the access token to communicate to the api with.
     *
     * @param $accessToken
     *
     * @return $this
     */
    public function setAccessToken(AccessToken $accessToken)
    {
        $this->accessToken = $accessToken->getToken();

        return $this;
    }

    /**
     * Returns the http client.
     *
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    public function getAuthHeader()
    {
        return ['Authorization' => 'Bearer '.$this->getAccessToken()];
    }

    public function getPoniverseUrl()
    {
        return $this->poniverseUrl;
    }

    public function getPonyfmUrl()
    {
        return $this->ponyfmUrl;
    }

    /**
     * Returns the Poniverse OAuth Provider class.
     *
     * @param array $options
     * @return PoniverseProvider
     */
    public function getOAuthProvider(array $options = [])
    {
        $options = array_merge([
            'clientId' => $this->clientId,
            'clientSecret' => $this->clientSecret,
        ], $options);

        return new PoniverseProvider($options);
    }
}
