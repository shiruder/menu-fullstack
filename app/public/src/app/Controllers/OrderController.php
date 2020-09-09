<?php
 
namespace App\Controllers;
 
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class OrderController
{
    protected $httpClientService;

    public function __construct($service)
    {
        $this->httpClientService = $service;
    }

    public function index(Request $request, Application $app)
    {
        $response = $this->httpClientService->createRequest(
            'get',
            'http://nginx-api/api/v1/orders/' . $request->get('id')
        );

        $order = json_decode(
            $response->getBody(),
            true
        );

        $response = $this->httpClientService->createRequest(
            'get',
            'http://nginx-api/api/v1/users/' . $order['id']
        );

        $user = json_decode(
            $response->getBody(),
            true
        );

        return $app['twig']->render(
            'order.html.twig', [
                'order' => $order,
                'user' => $user,
            ]
        );
    }
}