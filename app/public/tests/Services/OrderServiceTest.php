<?php

namespace Tests\Services;

class OrderServiceTest extends \PHPUnit_Framework_TestCase
{

public function testGetOrders()
    {
        $mockOrderService = $this->getMockBuilder(App\Services\HttpClientService::class)
            ->disableOriginalConstructor()
            ->setMethods(['createRequest'])
            ->getMock();

        $mockOrderServiceBody = $this->getMockBuilder(App\Services\HttpClientService::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBody'])
            ->getMock();

        $mockOrderServiceBody->expects($this->at(0)) // Mock the  first call
            ->method('getBody')
            ->willReturn('[{"id":1,"user_id":1,"value":"140.99","status":"Novo","date":"2020-02-01 01:00:00","created_at":"2020-09-02 01:22:44"}]');

        $mockOrderServiceBody->expects($this->at(1)) // Mock the  second call
            ->method('getBody')
            ->willReturn('{"id":1,"first_name":"Manuela","last_name":"da Silva","email":"manuela@example.com"}');

        $mockOrderService->method('createRequest')
            ->willReturn($mockOrderServiceBody);
    
        $orderService = new \App\Services\OrderService(
            $mockOrderService
        );        


        $this->assertEquals(
            [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'value' => 140.99,
                    'status' => 'Novo',
                    'date' => '2020-02-01 01:00:00',
                    'created_at' => '2020-09-02 01:22:44',
                    'user' => [
                        'id' => 1,
                        'first_name' => 'Manuela',
                        'last_name' => 'da Silva',
                        'email' => 'manuela@example.com'
                    ]
                ]
            ], 
            $orderService->getOrders()
        );
    }

    public function testGetOrder()
    {
        $mockOrderService = $this->getMockBuilder(App\Services\HttpClientService::class)
            ->disableOriginalConstructor()
            ->setMethods(['createRequest'])
            ->getMock();

        $mockOrderServiceBody = $this->getMockBuilder(App\Services\HttpClientService::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBody'])
            ->getMock();

        $mockOrderServiceBody->method('getBody')
            ->willReturn('{"id":1,"user_id":1,"value":"140.99","status":"Novo","date":"2020-02-01 01:00:00","created_at":"2020-09-02 01:22:44"}');

        $mockOrderService->method('createRequest')
            ->willReturn($mockOrderServiceBody);
    
        $orderService = new \App\Services\OrderService(
            $mockOrderService
        );

        $this->assertEquals(
            [
                'id' => 1,
                'user_id' => 1,
                'value' => 140.99,
                'status' => 'Novo',
                'date' => '2020-02-01 01:00:00',
                'created_at' => '2020-09-02 01:22:44'
            ], 
            $orderService->getOrder(1)
        );
    }
}
