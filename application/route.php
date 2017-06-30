<?php

use think\Route;

Route::get('/', 'index/Index/index');
Route::get(':name', 'index/Index/read');
