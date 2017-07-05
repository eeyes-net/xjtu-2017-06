<?php

use think\Route;

Route::group('admin', function () {
    Route::get('login', 'admin/Login/loginForm');
    Route::post('login', 'admin/Login/login');
    Route::any('logout', 'admin/Login/logout');
    Route::get('/', 'admin/Index/index');
    Route::get(':type_id/:id', 'admin/Index/edit');
    Route::put(':type_id/:id', 'admin/Index/update');
});

Route::group('mobile', function () {
    Route::get('/', 'mobile/Index/index');
    Route::get('colleges', 'mobile/Index/colleges');
    Route::get(':name', 'mobile/Index/read');
});

Route::get('/', 'index/Index/index');
Route::get(':name', 'index/Index/read');
