<?php

namespace Poniverse\Lib\Service;

use Poniverse\Lib\Errors\ApiException;
use Poniverse\Lib\Errors\Error;
use Psr\Http\Message\ResponseInterface;

class PonyfmService extends Service
{
    /**
     * @param ResponseInterface $response
     *
     * @throws ApiException
     */
    protected function handleError(ResponseInterface $response)
    {
        $response = json_decode($response->getBody(), true);

        $errorMessages = [];

        foreach ($response['errors'] as $type => $messages) {
            $errorMessages = array_merge($errorMessages, $messages);
        }

        $errors = array_map(function ($errorMessage) use ($response) {
            return new Error($response['title'], $errorMessage);
        }, $errorMessages);

        throw new ApiException($response->getStatusCode(), $errors);
    }
}
