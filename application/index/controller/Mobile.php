<?php
namespace app\index\controller;

class Mobile
{
    public function index()
    {
        if (!is_mobile()) {
            return redirect(url('index/Index/index'));
        }
        return view();
    }

    public function read($name)
    {
        if (!is_html_available('mobile', $name)) {
           return response('', 404);
        }
        $file = get_html_path('mobile', $name);
        $content = file_exists($file) ? file_get_contents($file) : '';
        if (request()->isPjax()) {
            return response()->content($content ?: ' ');
        }
        return view('', compact('content'));
    }
}
