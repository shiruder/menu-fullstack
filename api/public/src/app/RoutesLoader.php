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
        $this->app['order.controller'] = function() {
            return new Controllers\OrderController(
                $this->app['order.service']
            );
        };

        $this->app['user.controller'] = function() {
            return new Controllers\UserController(
                $this->app['user.service']
            );
        };
    }

    public function bindRoutesToControllers()
    {
        $api = $this->app["controllers_factory"];

        $api->get('/orders', "order.controller:getAll");
        $api->get('/orders/{id}', "order.controller:getOne");
        $api->post('/orders/', "order.controller:save");
        $api->put('/orders/{id}', "order.controller:update");
        $api->delete('/orders/{id}', "order.controller:delete");

        $api->get('/users', "user.controller:getAll");
        $api->get('/users/{id}', "user.controller:getOne");
        $api->post('/users/', "user.controller:save");
        $api->put('/users/{id}', "user.controller:update");
        $api->delete('/users/{id}', "user.controller:delete");

        $this->app->mount(
            $this->app["api.endpoint"] . '/' . $this->app["api.version"], 
            $api
        );
    }
}

