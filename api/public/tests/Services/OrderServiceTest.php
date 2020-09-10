<?php

namespace Tests\Services;

class OrderServiceTest extends \PHPUnit_Framework_TestCase
{

    private $orderService;
    private $order;

    public function setUp()
    {
        $this->order = [
            "user_id" => "1",
            "value" => 1.99,
            "status" => "Novo",
            "date" => date('d/m/y h:i:s'),
            "created_at" => date('d/m/y h:i:s'),
        ];
    }

    public function testSave()
    {
        $mockOrderModel = $this->getMockBuilder(App\Models\OrderModel::class)
            ->disableOriginalConstructor()
            ->setMethods(['insertGetId'])
            ->getMock();

        $mockOrderModel->method('insertGetId')
            ->willReturn(1);
    
        $orderService = new \App\Services\OrderService(
            $mockOrderModel
        );

        $this->assertInternalType(
            "int", 
            $orderService->save([])
        );
    }

    public function testGetOne()
    {
        $mockOrderModel = $this->getMockBuilder(App\Models\OrderModel::class)
            ->disableOriginalConstructor()
            ->setMethods(['find'])
            ->getMock();

        $mockOrderModel->method('find')
            ->willReturn([]);
    
        $orderService = new \App\Services\OrderService(
            $mockOrderModel
        );

        $this->assertEquals(
            [], 
            $orderService->getOne($this->order)
        );
    }

    public function testGetAll()
    {
        $mockOrderModel = $this->getMockBuilder(App\Models\OrderModel::class)
            ->disableOriginalConstructor()
            ->setMethods(['all'])
            ->getMock();

        $mockOrderModel->method('all')
            ->willReturn([]);
    
        $orderService = new \App\Services\OrderService(
            $mockOrderModel
        );

        $this->assertEquals(
            [], 
            $orderService->getAll($this->order)
        );
    }

    public function testUpdateObject()
    {
        $mockOrderModelFind = $this->getMockBuilder(App\Models\OrderModel::class)
            ->disableOriginalConstructor()
            ->setMethods(['find'])
            ->getMock();

        $mockOrderModelUpdate = $this->getMockBuilder(App\Models\OrderModel::class)
            ->disableOriginalConstructor()
            ->setMethods(['update'])
            ->getMock();

        $mockOrderModelUpdate->method('update')
            ->willReturn(true);

        $mockOrderModelFind->method('find')
            ->willReturn($mockOrderModelUpdate);

        $orderService = new \App\Services\OrderService(
            $mockOrderModelFind
        );

        $this->assertEquals(
            true, 
            $orderService->update(1, $this->order)
        );        
    }

    public function testUpdateFalse()
    {
        $mockOrderModel = $this->getMockBuilder(App\Models\OrderModel::class)
            ->disableOriginalConstructor()
            ->setMethods(['find'])
            ->getMock();

        $mockOrderModel->method('find')
            ->willReturn(null);

        $orderService = new \App\Services\OrderService(
            $mockOrderModel
        );

        $this->assertEquals(
            false, 
            $orderService->update(1, $this->order)
        );        
    }

    public function testDelete()
    {
        $mockOrderModel = $this->getMockBuilder(App\Models\OrderModel::class)
            ->disableOriginalConstructor()
            ->setMethods(['destroy'])
            ->getMock();

        $mockOrderModel->method('destroy')
            ->willReturn(true);
    
        $orderService = new \App\Services\OrderService(
            $mockOrderModel
        );

        $this->assertEquals(
            true, 
            $orderService->delete($this->order)
        );
    }
}
