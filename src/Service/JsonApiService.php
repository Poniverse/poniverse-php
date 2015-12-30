<?php

namespace Poniverse\Lib\Service;

use Poniverse\Lib\Errors\ApiException;
use Poniverse\Lib\Errors\Error;
use Psr\Http\Message\ResponseInterface;

class JsonApiService extends Service
{
    /**
     * @param ResponseInterface $response
     *
     * @throws ApiException
     */
    protected function handleError(ResponseInterface $response)
    {
        $response = json_decode($response->getBody(), true);

        $errors = [];

        if (isset($errors['errors'])) {
            $errors = array_map(function ($error) {
                return new Error($error['title'], $error['detail']);
            }, $response['errors']);
        }

        throw new ApiException($response->getStatusCode(), $errors);
    }
}