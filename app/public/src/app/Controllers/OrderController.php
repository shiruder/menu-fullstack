<?php
 
namespace App\Controllers;
 
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class OrderController
{
    public function indexAction(Request $request, Application $app)
    {
        $url = 'http://nginx-api/api/v1/orders/' . $request->get('id');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $order = json_decode(curl_exec($ch));
        if ($order === false) {
            var_dump('CURL error: ' . curl_error($ch));
        }

        curl_close($ch);

        $url = 'http://nginx-api/api/v1/users/' . $order->user_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $user = json_decode(curl_exec($ch));
        if ($user === false) {
            var_dump('CURL error: ' . curl_error($ch));
        }

        curl_close($ch);

        return $app['twig']->render(
            'order.html.twig', [
                'order' => ($order),
                'user' => ($user)
            ]
        );
    }
}