<?php

$data = include dirname(dirname(__FILE__)) . '/common/data/data.php';

return [
    'types' => $data['types'],
    'posts' => $data['posts'],
];
