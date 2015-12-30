<?php

namespace Poniverse\Lib;

use GuzzleHttp\Client as HttpClient;
use League\OAuth2\Client\Token\AccessToken;

class Client
{
    /**
     * @var string|string
     */
    protected $accessToken = null;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    protected $poniverseUrl = 'http://api.poniverse.local';
    protected $ponyfmUrl = 'https://pony.fm';

    /**
     * Initializes the Poniverse Api client.
     *
     * @param \GuzzleHttp\Client $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
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
}
