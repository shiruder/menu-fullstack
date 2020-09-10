<?php

namespace App\Services;

class OrderService
{
    protected $httpClientService;

    public function __construct($httpClientService)
    {
        $this->httpClientService = $httpClientService;
    }

    public function getOrders()
    {
        $response = $this->httpClientService->createRequest(
            'get',
            'http://nginx-api/api/v1/orders'
        );

        $orders = json_decode(
            $response->getBody(),
            true
        );

        if ($orders) {
            foreach ($orders as $key => $order) {
                $response = $this->httpClientService->createRequest(
                    'get',
                    'http://nginx-api/api/v1/users/' . $order['user_id']
                );

                $orders[$key]['user'] = json_decode(
                    $response->getBody(),
                    true
                );
            }
        }


        return $orders;
    }

    public function getOrder($id)
    {
        $response = $this->httpClientService->createRequest(
            'get',
            'http://nginx-api/api/v1/orders/' . $id
        );

        return json_decode(
            $response->getBody(),
            true
        );
    }
}
