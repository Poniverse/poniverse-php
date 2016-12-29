<?php

/**
 * Copyright 2016 Peter Deltchev
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Poniverse\Lib\Service\Poniverse;

use Poniverse\Lib\Errors\InvalidAccessTokenException;
use Poniverse\Lib\Service\Service;

class AccessTokenInfo extends Service {

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @throws InvalidAccessTokenException
     * @throws \Poniverse\Lib\Errors\ApiException
     */
    protected function handleError(\Psr\Http\Message\ResponseInterface $response) {
        if (404 === $response->getStatusCode()) {
            throw new InvalidAccessTokenException('This access token is expired or invalid!');
        } else {
            throw new \Poniverse\Lib\Errors\ApiException(
                $response->getStatusCode(),
                ['response' => var_export($response, true)],
                'An unknown error occurred while contacting the Poniverse API.');
        }
    }

    /**
     * Gets information about the given access token.
     *
     * @link https://tools.ietf.org/html/draft-richer-oauth-introspection-06
     *
     * @param $accessTokenToIntrospect
     * @return \Poniverse\Lib\AccessToken
     */
    public function introspect($accessTokenToIntrospect) {
        $clientToken = $this->client->getOAuthProvider()->getAccessToken('client_credentials');
        $this->client->setAccessToken($clientToken);

        $request = $this->request(
            'post',
            $this->client->getPoniverseUrl() . "/v1/meta/introspect?token={$accessTokenToIntrospect}",
            ['headers' => array_merge(
                ['Accept' => 'application/json'],
                $this->client->getAuthHeader()
            )]
        );

        $response = json_decode($request->getBody(), true);

        $tokenInfo = new \Poniverse\Lib\AccessToken($accessTokenToIntrospect);
        $tokenInfo
            ->setIsActive($response['active'])
            ->setScopes($response['scope'])
            ->setClientId($response['client_id']);
        return $tokenInfo;
    }
}
