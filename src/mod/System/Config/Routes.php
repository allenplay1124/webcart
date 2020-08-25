<?php
/**
 * 系統管理路由
 */

 $routes->group('admin', function($routes) {
    $routes->group('system', function($routes) {
        //模組安裝
        $routes->group('modinfo', function ($routes) {
            $routes->post('install', '\Mod\System\Controllers\Modinfo::install');
            $routes->put('update', '\Mod\System\Controllers\Modinfo::update');
            $routes->delete('uninstall', '\Mod\System\Controllers\Modinfo::uninstall');
        });
        //系統基本設定
        $routes->group('setting', function ($routes) {
            $routes->get('index', '\Mod\System\Controllers\BaseSetting::index');
            $routes->put('update', '\Mod\System\Controllers\BaseSetting::update');
        });
        //模組管理
        $routes->group('modules', function($routes) {
            $routes->get('index', '\Mod\System\Controllers\Modules::index');
        });
        
    });
 });
