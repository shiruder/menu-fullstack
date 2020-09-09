<?php

namespace App\Services;

use GuzzleHttp\Client as Guzzle;

class HttpClientService
{
    protected $http;

    public function __construct(Guzzle $http)
    {
        $this->http = $http;
    }

    /**
     * @param string $method
     * @param string $path
     * @param array  $options
     */
     
    public function createRequest(
        string $method,
        string $path,
        array $options = []
    ) {
         return $this->http->$method(
            $path,
            $options
        );
    }
}