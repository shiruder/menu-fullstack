<?php

namespace App;

use Silex\Application;

class RoutesLoader
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->instantiateControllers();

    }

    private function instantiateControllers()
    {
        $this->app['index.controller'] = function() {
            return new Controllers\IndexController(
                $this->app['http_client.service']
            );
        };

        $this->app['order.controller'] = function() {
            return new Controllers\OrderController(
                $this->app['http_client.service']
            );
        };
    }

    public function bindRoutesToControllers()
    {
        $app = $this->app["controllers_factory"];

        $app->get('/', "index.controller:index");
        $app->get('/order/{id}', "order.controller:index");

        $this->app->mount(
            '/', 
            $app
        );
    }
}

