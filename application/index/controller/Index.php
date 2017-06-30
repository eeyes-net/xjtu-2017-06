<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        return view();
    }

    public function read($name)
    {
        if (!is_html_available('index', $name)) {
            $this->error('文件不存在');
        }
        $file = get_html_path('index', $name);
        $content = file_exists($file) ? file_get_contents($file) : '';
        return view('', compact('content'));
    }
}
