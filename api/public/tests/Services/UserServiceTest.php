<?php

namespace Tests\Services;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Illuminate\Database\Capsule\Manager as Capsule;

class UserServiceTest extends \PHPUnit_Framework_TestCase
{

    private $userService;
    private $user;

    public function setUp()
    {
        $app = new Application();

        require __DIR__ . '/../../config/test.php';

        $capsule = new Capsule();
        $capsule->addConnection($app['db.options']);
        $capsule->bootEloquent();

        $servicesLoader = new \App\ServicesLoader($app);
        $servicesLoader->bindServicesIntoContainer();

        $app->register(new ServiceControllerServiceProvider());

        $this->userService = new \App\Services\UserService(
            new \App\Models\UserModel()
        );

        $this->user = [
            'first_name' => 'Henrique',
            'last_name' => 'Shiruder',
            'email' => 'email@example.com',
        ];

        return $app;

    }

    public function testSave()
    {
        $id = $this->userService->save($this->user);
 
        $this->assertInternalType('int', $id);
        $this->userService->delete($id);
    }

    public function testGetOne()
    {
        $data = $this->userService->getOne(1);
        $this->assertEquals(1, $data->id);
    }

    public function testGetAll()
    {
        $data = $this->userService->getAll();
        $this->assertNotNull($data);
    }



    public  function testUpdate()
    {
        $id = $this->userService->save($this->user);
        $user = $this->user;
        $user['email'] = 'other@email.com';
        $this->userService->update($id, $user);
        $data = $this->userService->getOne($id);
        $this->assertEquals('other@email.com', $data['email']);
        $this->userService->delete($id);
    }

    function testDelete()
    {
        $id = $this->userService->save($this->user);
        $data = $this->userService->delete($id);
        $this->assertEquals(1, $data);
    }

}
