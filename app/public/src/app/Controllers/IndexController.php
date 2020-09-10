<?php
 
namespace App\Controllers;
 
use Silex\Application;

class IndexController
{
    protected $orderService;

    public function __construct($orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Application $app)
    {
        return $app['twig']->render(
            'index.html.twig', [
                'orders' => $this->orderService->getOrders()
            ]
        );
    }
}