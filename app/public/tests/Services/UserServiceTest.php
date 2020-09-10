<?php

namespace Tests\Services;

class UserServiceTest extends \PHPUnit_Framework_TestCase
{

public function testGetUser()
    {
        $mockUserService = $this->getMockBuilder(App\Services\HttpClientService::class)
            ->disableOriginalConstructor()
            ->setMethods(['createRequest'])
            ->getMock();

        $mockUserServiceBody = $this->getMockBuilder(App\Services\HttpClientService::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBody'])
            ->getMock();

        $mockUserServiceBody->method('getBody')
            ->willReturn('{"id":1,"first_name":"Manuela","last_name":"da Silva","email":"manuela@example.com"}');

        $mockUserService->method('createRequest')
            ->willReturn($mockUserServiceBody);
    
        $userService = new \App\Services\UserService(
            $mockUserService
        );

        $this->assertEquals(
            [
                'id' => 1,
                'first_name' => 'Manuela',
                'last_name' => 'da Silva',
                'email' => 'manuela@example.com'
            ], 
            $userService->getUser(1)
        );
    }
}
