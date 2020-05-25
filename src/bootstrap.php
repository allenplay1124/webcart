<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => getenv('database.default.DBDriver'),
    'host'      => getenv('database.default.hostname'),
    'database'  => getenv('database.default.database'),
    'username'  => getenv('database.default.username'),
    'password'  => getenv('database.default.password'),
    'charset'   => getenv('database.default.charset'),
    'collation' => getenv('database.default.collation'),
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$capsule::connection('default')->enableQueryLog();