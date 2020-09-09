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
        $this->app['order.service'] = function() {
            return new Services\OrderService(new Models\OrderModel());
        };

        $this->app['user.service'] = function() {
            return new Services\UserService(new Models\UserModel());
        };
    }
}