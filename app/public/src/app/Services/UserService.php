<?php

namespace App\Services;

class UserService
{
    protected $httpClientService;

    public function __construct($httpClientService)
    {
        $this->httpClientService = $httpClientService;
    }

    public function getUser($id)
    {
        $response = $this->httpClientService->createRequest(
            'get',
            'http://nginx-api/api/v1/users/' . $id
        );

        return json_decode(
            $response->getBody(),
            true
        );
    }
}
