<?php

namespace app\index\controller;

use think\Cookie;

class Index
{
    public function index()
    {
        if (is_mobile() && !Cookie::get('redirected')) {
            Cookie::set('redirected', true, [
                'expire' => '300',
            ]);
            return redirect(url('mobile/Index/index'));
        }
        return $this->read('introduction');
    }

    public function read($name)
    {
        if ($name === 'college') {
            return $this->read('pengkang');
        }
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
