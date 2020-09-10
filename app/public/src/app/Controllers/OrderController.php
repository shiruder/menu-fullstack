<?php
 
namespace App\Controllers;
 
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class OrderController
{
    protected $orderService;
    protected $userService;

    public function __construct($userService, $orderService)
    {
        $this->userService = $userService;
        $this->orderService = $orderService;
    }

    public function index(Request $request, Application $app)
    {
        $order = $this->orderService->getOrder(
            $request->get('id')
        );

        $user = $this->userService->getUser(
            $order['id']
        );

        return $app['twig']->render(
            'order.html.twig', [
                'order' => $order,
                'user' => $user,
            ]
        );
    }
}