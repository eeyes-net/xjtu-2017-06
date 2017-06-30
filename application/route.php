<?php

use think\Route;

Route::get('test', function () {
    var_dump(\think\Env::get('admin.password'));
    exit;
});

Route::get('/', 'index/Index/index');
Route::get(':name', 'index/Index/read');

Route::group('admin', function () {
    Route::get('login', 'admin/Index/loginForm');
    Route::post('login', 'admin/Index/login');
    Route::get('/', 'admin/Index/index');
    Route::get(':type/:name', 'admin/Index/edit');
    Route::put(':type/:name', 'admin/Index/update');
});
