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
    }
}