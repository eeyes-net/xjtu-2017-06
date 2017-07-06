<?php
if (count(get_included_files()) <= 1) {
    exit;
}

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['think'])
    || !isset($_SESSION['think']['is_login'])
    || !$_SESSION['think']['is_login']
) {
    echo json_encode(array(
        'state' => '请先登录',
    ));
    exit;
}
