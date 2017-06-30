<?php

namespace app\admin\controller;

use think\Controller;
use think\exception\HttpResponseException;
use think\Session;

class Index extends Controller
{
    protected $beforeActionList = [
        'mustLogin',
    ];

    protected function mustLogin()
    {
        if (!Session::get('is_login')) {
            throw new HttpResponseException(redirect(url('admin/Login/loginForm')));
        }
    }

    public function index()
    {
        return view('base');
    }

    public function edit($type, $name)
    {
        if (!is_html_available($type, $name)) {
            $this->error('文件不存在');
        }
        $file = get_html_path($type, $name);
        $content = file_exists($file) ? file_get_contents($file) : '';
        return view('', compact('content'));
    }

    public function update($type, $name)
    {
        if (!is_html_available($type, $name)) {
            $this->error('文件不存在');
        }
        $file = get_html_path($type, $name);
        $content = request()->put('content');
        file_put_contents($file, $content);
        Session::flash('save_ok', '文件保存成功');
        return redirect($_SERVER['HTTP_REFERER']);
    }
}
