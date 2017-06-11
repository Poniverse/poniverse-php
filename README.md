# poniverse-php
[![Build Status](https://travis-ci.org/Poniverse/poniverse-php.svg?branch=master)](https://travis-ci.org/Poniverse/poniverse-php) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Poniverse/poniverse-php/badges/quality-score.png?s=7d517521c412c0adf149be941eebb82b13051ec9)](https://scrutinizer-ci.com/g/Poniverse/poniverse-php/) [![Code Coverage](https://scrutinizer-ci.com/g/Poniverse/poniverse-php/badges/coverage.png?s=07f581f7e79b32a700e1fad64950f56179a61bf1)](https://scrutinizer-ci.com/g/Poniverse/poniverse-php/)

## Installation

Require this package in composer.json and update

    "poniverse/api": "dev-master"
    
### Normal Setup

Example Code:

    $config = [
        'client_id' => 'YOUR_CLIENT_ID'
        'client_secret' => 'YOUR_CLIENT_SECRET'
        'host_url' => 'https://api.poniverse.net'
    ];

    $poniverse = new Poniverse(
        $config['client_id'],
        $config['client_secret'],
        new Client([
            'base_url' => [$config['host_url'], ['version' => 'v' . Poniverse::VERSION]]
        ])
    );
    
    $poniverse->setAccessToken('GRANTED_ACCESS_TOKEN');
    
    $user = $poniverse->user->get();
    // $user['display_name'];
    // $user['email'];

### Laravel 4 Setup

Open up `app/config/app.php` and add this line in your `providers` section

    'Poniverse\Api\ApiServiceProvider',

In the same file add this line to the ```aliases``` section

    'Poniverse' => 'Poniverse\Api\Facades\Poniverse',

Publish the configuration and then edit it

    php artisan config:publish poniverse/api
