<?php
/**
 * 系統管理路由
 */

 $routes->group('admin', function($routes) {
    $routes->group('system', function($routes) {
        $routes->get('base-setting', '\Mod\System\Controllers\SystemSetting::baseSetting');
    });
 });
