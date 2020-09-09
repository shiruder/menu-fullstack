<?php

use App\Models\Order;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Silex\Provider\ServiceControllerServiceProvider;
use Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Events\Dispatcher;
use \Illuminate\Container\Container;

$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

$capsule = new Capsule();
$capsule->addConnection($app["db.options"]);
$capsule->bootEloquent();

$servicesLoader = new App\ServicesLoader($app);
$servicesLoader->bindServicesIntoContainer();

$app->register(new ServiceControllerServiceProvider());

$routesLoader = new App\RoutesLoader($app);
$routesLoader->bindRoutesToControllers();

$app->error(
    function (\Exception $e, Request $request, $code) use ($app) {
        return new JsonResponse(
            [
                "statusCode" => $code, 
                "message" => $e->getMessage()
            ]
        );
    }
);
$app['debug'] = true;
return $app;
