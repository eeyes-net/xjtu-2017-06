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
        $file = config('html.path') . DS . 'index' . DS . $name . '.html';
        if (!file_exists($file)) {
            return response('', 404);
        }
        $content = file_get_contents($file);
        return view('', compact('content'));
    }
}
