<?php
/**
 * 系統管理路由
 */

 $routes->group('admin', function($routes) {
    $routes->group('system', function($routes) {
        $routes->get('show', '\Mod\System\Controllers\SystemSetting::show');
    });
 });
