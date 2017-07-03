<?php

namespace app\index\controller;

class Index
{
    public function index()
    {
        if (is_mobile()) {
            return redirect(url('index/Mobile/index'));
        }
        return redirect(url('index/Index/read', ['name' => 'introduction']));
    }

    public function read($name)
    {
        if (!is_html_available('index', $name)) {
            return response('', 404);
        }
        $file = get_html_path('index', $name);
        $content = file_exists($file) ? file_get_contents($file) : '';
        if (request()->isPjax()) {
            return view('pjax', compact('name', 'content'));
        }
        return view('read', compact('name', 'content'));
    }
}
