<?php

namespace Tests;

use Silex\WebTestCase;

/**
 * Silex API TestCase
 */
abstract class TestCase extends WebTestCase 
{
      
    /**
    * SetUp Method
    */
    public function setUp() 
    {
        parent::setUp();
    }

    public function createApplication() 
    {
        $app = new \Silex\Application();
        return $app;
    }

    /**
     * @param string $method
     * @param string $path
     * @param array  $options
     */
     
    protected function createRequest(
        string $method,
        string $path,
        array $options = []
    ) {
        $client = new \GuzzleHttp\Client();

        return $client->$method(
            $path,
            $options
        );
    }
}