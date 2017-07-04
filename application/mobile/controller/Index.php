<?php

namespace app\mobile\controller;

class Index
{
    public function index()
    {
        return view();
    }

    public function colleges() {
        $content = view('mobile@index/colleges')->getContent();
        return view('read', compact('name', 'content'));
    }

    public function read($name)
    {
        if (!is_html_available('mobile', $name)) {
            return response('', 404);
        }
        $file = get_html_path('mobile', $name);
        $content = file_exists($file) ? file_get_contents($file) : '';
        if (request()->isPjax()) {
            return $content;
        }
        return view('read', compact('name', 'content'));
    }
}
