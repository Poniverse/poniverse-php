<?php namespace Poniverse\Api;

use GuzzleHttp\Client;
use Poniverse\Api\Resource\User;

class Poniverse
{
    /**
     * Version of the api this package works with
     */
    const VERSION = 1;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var null|string
     */
    protected $accessToken = null;

    /**
     * @var Client
     */
    protected $client;

    /**
     * Initializes the Poniverse Api
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param \GuzzleHttp\Client $client
     * @return Poniverse
     */
    public function __construct($clientId, $clientSecret, Client $client)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->client = $client;
        $this->host = $client->getBaseUrl();
    }

    /**
     * Returns the set client id
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Returns the set client secret
     *
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * Returns the host being used
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Returns the set access key
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Sets the access token to communicate to the api with
     *
     * @param $accessToken
     * @return $this
     */
    public function setAccessToken($accessToken)
    {
        $this->client->setDefaultOption('headers/Authorization', $accessToken);

        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Returns the http client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Returns the user resource class
     *
     * @return User
     */
    public function user()
    {
        return new User($this);
    }
}