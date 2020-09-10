<?php

namespace Tests\Services;

class UserServiceTest extends \PHPUnit_Framework_TestCase
{

    private $user;

    public function setUp()
    {
        $this->user = [
            'first_name' => 'Henrique',
            'last_name' => 'Shiruder',
            'email' => 'email@example.com',
        ];
    }

    public function testSave()
    {
        $mockUserModel = $this->getMockBuilder(App\Models\UserModel::class)
            ->disableOriginalConstructor()
            ->setMethods(['insertGetId'])
            ->getMock();

        $mockUserModel->method('insertGetId')
            ->willReturn(1);
    
        $userService = new \App\Services\UserService(
            $mockUserModel
        );

        $this->assertInternalType(
            "int", 
            $userService->save([])
        );
    }

    public function testGetOne()
    {
        $mockUserModel = $this->getMockBuilder(App\Models\UserModel::class)
            ->disableOriginalConstructor()
            ->setMethods(['find'])
            ->getMock();

        $mockUserModel->method('find')
            ->willReturn([]);
    
        $userService = new \App\Services\UserService(
            $mockUserModel
        );

        $this->assertEquals(
            [], 
            $userService->getOne($this->user)
        );
    }

    public function testGetAll()
    {
        $mockUserModel = $this->getMockBuilder(App\Models\UserModel::class)
            ->disableOriginalConstructor()
            ->setMethods(['all'])
            ->getMock();

        $mockUserModel->method('all')
            ->willReturn([]);
    
        $userService = new \App\Services\UserService(
            $mockUserModel
        );

        $this->assertEquals(
            [], 
            $userService->getAll($this->user)
        );
    }

    public function testUpdateObject()
    {
        $mockUserModelFind = $this->getMockBuilder(App\Models\UserModel::class)
            ->disableOriginalConstructor()
            ->setMethods(['find'])
            ->getMock();

        $mockUserModelUpdate = $this->getMockBuilder(App\Models\UserModel::class)
            ->disableOriginalConstructor()
            ->setMethods(['update'])
            ->getMock();

        $mockUserModelFind->method('find')
            ->willReturn($mockUserModelUpdate);
    
        $mockUserModelUpdate->method('update')
            ->willReturn(true);

        $userService = new \App\Services\UserService(
            $mockUserModelFind
        );

        $this->assertEquals(
            true, 
            $userService->update(1, $this->user)
        );        
    }

    public function testUpdateFalse()
    {
        $mockUserModel = $this->getMockBuilder(App\Models\UserModel::class)
            ->disableOriginalConstructor()
            ->setMethods(['find'])
            ->getMock();

        $mockUserModel->method('find')
            ->willReturn(null);

        $userService = new \App\Services\UserService(
            $mockUserModel
        );

        $this->assertEquals(
            false, 
            $userService->update(1, $this->user)
        );        
    }

    public function testDelete()
    {
        $mockUserModel = $this->getMockBuilder(App\Models\UserModel::class)
            ->disableOriginalConstructor()
            ->setMethods(['destroy'])
            ->getMock();

        $mockUserModel->method('destroy')
            ->willReturn(true);
    
        $userService = new \App\Services\UserService(
            $mockUserModel
        );

        $this->assertEquals(
            true, 
            $userService->delete($this->user)
        );
    }
}
