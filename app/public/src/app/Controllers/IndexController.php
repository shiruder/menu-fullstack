<?php
 
namespace App\Controllers;
 
use Silex\Application;

class IndexController
{
    protected $httpClientService;

    public function __construct($service)
    {
        $this->httpClientService = $service;
    }

    public function index(Application $app)
    {
        $response = $this->httpClientService->createRequest(
            'get',
            'http://nginx-api/api/v1/orders'
        );

        return $app['twig']->render(
            'index.html.twig', [
                'orders' => json_decode(
                    $response->getBody(),
                    true
                )
            ]
        );
    }
}