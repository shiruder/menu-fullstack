<?php

namespace Tests\Services;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Illuminate\Database\Capsule\Manager as Capsule;

class OrderServiceTest extends \PHPUnit_Framework_TestCase
{

    private $orderService;
    private $order;

    public function setUp()
    {
        $app = new Application();

        require __DIR__ . '/../../config/test.php';

        $capsule = new Capsule();
        $capsule->addConnection($app["db.options"]);
        $capsule->bootEloquent();

        $servicesLoader = new \App\ServicesLoader($app);
        $servicesLoader->bindServicesIntoContainer();

        $app->register(new ServiceControllerServiceProvider());

        $this->orderService = new \App\Services\OrderService(
            new \App\Models\OrderModel()
        );

        $this->order = [
            "user_id" => "1",
            "value" => 1.99,
            "status" => "Novo",
            "date" => date('d/m/y h:i:s'),
            "created_at" => date('d/m/y h:i:s'),
        ];

        return $app;

    }

    public function testSave()
    {
        $id = $this->orderService->save($this->order);
 
        $this->assertInternalType("int", $id);
        $this->orderService->delete($id);
    }

    public function testGetOne()
    {
        $data = $this->orderService->getOne(1);
        $this->assertEquals(1, $data->id);
    }

    public function testGetAll()
    {
        $data = $this->orderService->getAll();
        $this->assertNotNull($data);
    }

    public  function testUpdate()
    {
        $id = $this->orderService->save($this->order);
        $order = $this->order;
        $order['status'] = "Pendente";
        $this->orderService->update($id, $order);
        $data = $this->orderService->getOne($id);
        $this->assertEquals("Pendente", $data['status']);
        $this->orderService->delete($id);
    }

    function testDelete()
    {
        $id = $this->orderService->save($this->order);
        $data = $this->orderService->delete($id);
        $this->assertEquals(1, $data);
    }

}
