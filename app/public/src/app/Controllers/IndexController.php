<?php
 
namespace App\Controllers;
 
use Silex\Application;

class IndexController
{
    public function indexAction(Application $app)
    {
        $url = 'http://nginx-api/api/v1/orders';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        if ($output === false) {
            var_dump('CURL error: ' . curl_error($ch));
        }

        curl_close($ch);

        return $app['twig']->render(
            'index.html.twig', [
                'orders' => json_decode($output)
            ]
        );
    }
}