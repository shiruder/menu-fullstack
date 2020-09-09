<?php

namespace Tests\Controllers;

use Silex\Application;
use Tests\TestCase;
use GuzzleHttp\Psr7\Request;

class OrderControllerTest extends TestCase 
{
    public function testSave()
    {
        $response = $this->createRequest(
            'post',
            'http://127.0.0.1:8091/api/v1/orders/',
            [
                'form_params' => [
                    'order' => [
                        "user_id" => "1",
                        "value" => 13.99,
                        "status" => "Novo",
                        "date" => date('d/m/y h:i:s'),
                        "created_at" => date('d/m/y h:i:s'),
                    ],
                ],
            ]
        );

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals(
            'application/json', 
            $response->getHeaderLine('Content-Type')
        );

        $order = json_decode($response->getBody(), true);

        $response = $this->createRequest(
            'delete', 
            'http://localhost:8091/api/v1/orders/' . $order['id'],
            []
        );
    }

    public function testGetOne()
    {
        $response = $this->createRequest(
            'get',
            'http://127.0.0.1:8091/api/v1/orders/1'
        );

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(
            'application/json', 
            $response->getHeaderLine('Content-Type')
        );
    }

    public function testGetOneNotFound()
    {
        $response = $this->createRequest(
            'get',
            'http://127.0.0.1:8091/api/v1/orders/0',
            [
                'http_errors' => false
            ]
        );

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals(
            'application/json', 
            $response->getHeaderLine('Content-Type')
        );
    }

    public function testGetAll()
    {
        $response = $this->createRequest(
            'get',
            'http://localhost:8091/api/v1/orders/'
        );

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(
            'application/json', 
            $response->getHeaderLine('Content-Type')
        );
    }



    public  function testUpdate()
    {
        $response = $this->createRequest(
            'post',
            'http://127.0.0.1:8091/api/v1/orders/',
            [
                'form_params' => [
                    'order' => [
                        "user_id" => "1",
                        "value" => 9.99,
                        "status" => "Novo",
                        "date" => date('d/m/y h:i:s'),
                        "created_at" => date('d/m/y h:i:s'),
                    ],
                ],
            ]
        );

        $order = json_decode($response->getBody(), true);

        $response = $this->createRequest(
            'put',
            'http://127.0.0.1:8091/api/v1/orders/' . $order['id'],
            [
                'form_params' => [
                    'order' => [
                        "status" => "Entregue",
                    ],
                ],
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(
            'application/json', 
            $response->getHeaderLine('Content-Type')
        );

        $response = $this->createRequest(
            'get', 
            'http://127.0.0.1:8091/api/v1/orders/' . $order['id'],
            []
        );

        $data = json_decode($response->getBody(), true);

        $this->assertEquals("Entregue", $data['status']);

        $response = $this->createRequest(
            'delete', 
            'http://localhost:8091/api/v1/orders/' . $order['id'],
            []
        );
    }

    public  function testUpdateNotFound()
    {
        $response = $this->createRequest(
            'put',
            'http://127.0.0.1:8091/api/v1/orders/0',
            [
                'http_errors' => false,
                'form_params' => [
                    'order' => [
                        "status" => "Entregue",
                    ],
                ],
            ]
        );

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals(
            'application/json', 
            $response->getHeaderLine('Content-Type')
        );
    }


    function testDelete()
    {
        $response = $this->createRequest(
            'post',
            'http://127.0.0.1:8091/api/v1/orders/',
            [
                'form_params' => [
                    'order' => [
                        "user_id" => "1",
                        "value" => 7.99,
                        "status" => "Novo",
                        "date" => date('d/m/y h:i:s'),
                        "created_at" => date('d/m/y h:i:s'),
                    ],
                ],
            ]
        );

        $order = json_decode($response->getBody(), true);

        $response = $this->createRequest(
            'delete', 
            'http://localhost:8091/api/v1/orders/' . $order['id'],
            []
        );

        $this->assertEquals(204, $response->getStatusCode());
    }

    function testDeleteNotFound()
    {
        $response = $this->createRequest(
            'delete', 
            'http://localhost:8091/api/v1/orders/0',
            [
                'http_errors' => false
            ]
        );

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals(
            'application/json', 
            $response->getHeaderLine('Content-Type')
        );
    }
}
