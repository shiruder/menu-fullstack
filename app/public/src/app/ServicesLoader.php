<?php

namespace App;

use Silex\Application;

class ServicesLoader
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function bindServicesIntoContainer()
    {
        $this->app['http_client.service'] = function() {
            return new Services\HttpClientService(
                new \GuzzleHttp\Client()
            );
        };

        $this->app['order.service'] = function() {
            return new Services\OrderService(
                $this->app['http_client.service']
            );
        };

        $this->app['user.service'] = function() {
            return new Services\UserService(
                $this->app['http_client.service']
            );
        };
    }
}