<?php

use think\Route;

Route::get('/', 'index/Index/index');
Route::get(':name', 'index/Index/read');

Route::group('admin', function () {
    Route::get('login', 'admin/Index/loginForm');
    Route::post('login', 'admin/Index/login');
    Route::get('/', 'admin/Index/index');
    Route::get(':name', 'admin/Index/edit');
    Route::put(':name', 'admin/Index/update');
});
