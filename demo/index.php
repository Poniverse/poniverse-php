<?php

require '../vendor/autoload.php';

$poniverseClient = new \Poniverse\Lib\Client(
    'demo',
    'demo',
    new GuzzleHttp\Client()
);

// OAUTH DANCE

$oauthProvider = $poniverseClient->getOAuthProvider([
    'redirectUri' => 'http://lib.pv/index.php',
]);

try {
    // FYI, This is for development use only, you will never be able to
    // use the password grant on our production servers.
    $accessToken = $oauthProvider->getAccessToken('password', [
        'username' => 'test',
        'password' => 'test',
    ]);

    $poniverseClient->setAccessToken($accessToken);
} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    dd($e->getMessage());
}

$resourceOwner = $oauthProvider->getResourceOwner($accessToken);

// API TEST

$userService = new \Poniverse\Lib\Service\Poniverse\User($poniverseClient);

$anotherUser = $userService->get('5582ba3b-46ab-46f8-95e1-00bb1b8748c7');

$anotherUser->display_name = 'Test Dummy';

try {
    $userService->update($anotherUser);
} catch (\Poniverse\Lib\Errors\ApiException $e) {
    // TODO: Handle Error
}

dd($resourceOwner, $anotherUser);
