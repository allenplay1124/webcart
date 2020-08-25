<?php

$routes->group('admin', function ($routes) {
    $routes->group('user', function ($routes) {
        //模組安裝
        $routes->group('modinfo', function ($routes) {
            $routes->post('install', '\Mod\User\Controllers\Modinfo::install');
            $routes->put('update', '\Mod\User\Controllers\Modinfo::update');
            $routes->delete('uninstall', '\Mod\User\Controllers\Modinfo::uninstall');
        });
    });
});