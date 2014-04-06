<?php namespace Poniverse\Api;

use GuzzleHttp\Client;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('poniverse/api', 'poniverse/api');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['poniverse.api'] = $this->app->share(function(Container $app) {
            $config = $app['config']->get('poniverse/api::config');

            return new Poniverse(
                $config['client_id'],
                $config['client_secret'],
                new Client([
                    'base_url' => [$config['host_url'], ['version' => 'v' . Poniverse::VERSION]]
                ])
            );
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return ['poniverse.api'];
    }

}
