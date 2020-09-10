<?php

namespace Tests\Controllers;

use Silex\Application;
use Tests\TestCase;
use GuzzleHttp\Psr7\Request;

class UserControllerTest extends TestCase 
{
    public function testSave()
    {
        $response = $this->createRequest(
            'post',
            'http://127.0.0.1:8091/api/v1/users/',
            [
                'form_params' => [
                    'user' => [
                        'first_name' => 'Henrique',
                        'last_name' => 'Shiruder',
                        'email' => 'email@example.com'
                    ],
                ],
            ]
        );

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals(
            'application/json', 
            $response->getHeaderLine('Content-Type')
        );

        $user = json_decode($response->getBody(), true);

        $response = $this->createRequest(
            'delete', 
            'http://localhost:8091/api/v1/users/' . $user['id'],
            []
        );
    }

    public function testGetOne()
    {
        $response = $this->createRequest(
            'get',
            'http://127.0.0.1:8091/api/v1/users/1'
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
            'http://127.0.0.1:8091/api/v1/users/1231413141',
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
            'http://localhost:8091/api/v1/users/'
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
            'http://127.0.0.1:8091/api/v1/users/',
            [
                'form_params' => [
                    'user' => [
                        'first_name' => 'Henrique',
                        'last_name' => 'Shiruder',
                        'email' => 'email@example.com',
                    ],
                ],
            ]
        );

        $user = json_decode($response->getBody(), true);

        $response = $this->createRequest(
            'put',
            'http://127.0.0.1:8091/api/v1/users/' . $user['id'],
            [
                'form_params' => [
                    'user' => [
                        "email" => "other@example.com",
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
            'http://127.0.0.1:8091/api/v1/users/' . $user['id'],
            []
        );

        $data = json_decode($response->getBody(), true);

        $this->assertEquals("other@example.com", $data['email']);

        $response = $this->createRequest(
            'delete', 
            'http://localhost:8091/api/v1/users/' . $user['id'],
            []
        );
    }

    public  function testUpdateNotFound()
    {
        $response = $this->createRequest(
            'put',
            'http://127.0.0.1:8091/api/v1/users/1231413141',
            [
                'http_errors' => false,
                'form_params' => [
                    'user' => [
                        "email" => "other@email.com",
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
            'http://127.0.0.1:8091/api/v1/users/',
            [
                'form_params' => [
                    'user' => [
                        'first_name' => 'Henrique',
                        'last_name' => 'Shiruder',
                        'email' => 'email@example.com',
                    ],
                ],
            ]
        );

        $user = json_decode($response->getBody(), true);

        $response = $this->createRequest(
            'delete', 
            'http://localhost:8091/api/v1/users/' . $user['id'],
            []
        );

        $this->assertEquals(204, $response->getStatusCode());
    }

    function testDeleteNotFound()
    {
        $response = $this->createRequest(
            'delete', 
            'http://localhost:8091/api/v1/users/1231413141',
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
