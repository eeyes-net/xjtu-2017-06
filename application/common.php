<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function is_html_available($type, $name)
{
    return in_array($type, ['index', 'mobile'])
        && in_array($name, config('html.list')[$type]);
}

function get_html_path($type, $name) {
    return config('html.path') . DS . $type . DS . $name . '.html';
}
