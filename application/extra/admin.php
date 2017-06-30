<?php

use think\Env;

return [
    'username' => Env::get('ADMIN_USERNAME', 'admin'),
    'password' => Env::get('ADMIN_PASSWORD', 'admin'),
];
