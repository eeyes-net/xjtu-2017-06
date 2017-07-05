<?php

$data = include dirname(dirname(__FILE__)) . '/common/data/data.php';

return [
    'types' => $data['types'],
    'posts' => $data['posts'],
    'college_ids' => $data['college_ids'],
    'menu_index' => $data['menu']['index'],
    'menu_mobile' => $data['menu']['mobile'],
];
