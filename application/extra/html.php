<?php

$data = include dirname(dirname(__FILE__)) . '/common/data/data.php';

return [
    'path' => ROOT_PATH . 'storage' . DS . 'html',
    'list' =>  $data['list'],
    'menu' => $data['menu'],
    'colleges' => $data['colleges'],
];
