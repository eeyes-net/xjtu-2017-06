<?php

use think\Route;

Route::group('admin', function () {
    Route::get('login', 'admin/Login/loginForm');
    Route::post('login', 'admin/Login/login');
    Route::any('logout', 'admin/Login/logout');
    Route::get('/', 'admin/Index/index');
    Route::get(':type/:name', 'admin/Index/edit');
    Route::put(':type/:name', 'admin/Index/update');
});

Route::group('mobile', function () {
    Route::get('/', 'index/Mobile/index');
    Route::get(':name', 'index/Mobile/read');
});

Route::get('/', 'index/Index/index');
Route::get(':name', 'index/Index/read');
