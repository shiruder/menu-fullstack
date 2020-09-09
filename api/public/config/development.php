<?php

$app["api.endpoint"] = 'api';
$app["api.version"] = 'v1';
$app['debug'] = true;

/**
 * SQLite database file
 */
$app['db.options'] = [
    "driver"     => "mysql",
    "host"       => "172.24.0.1",
    "database"   => "sales",
    "port"       => "3306",
    "username"   => "root",
    "password"   => "root",
    "charset"    => "latin1",
];
