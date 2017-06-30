<?php

namespace app\admin\controller;

use think\Controller;
use think\Session;

class Index extends Controller
{

    protected $beforeActionList = [
        'isLogin' => ['except' => ['loginForm', 'login']],
    ];

    protected function isLogin()
    {
        if (!Session::has('is_login') || !Session::get('is_login')) {
            $this->error('请先登录', url('admin/Index/loginForm'));
        }
    }

    public function loginForm()
    {
        return view();
    }

    public function login()
    {
        $username = request()->post('username');
        $password = request()->post('password');
        if ($username === config('admin.username')
            && $password === config('admin.password')
        ) {
            Session::set('is_login', 'true');
            $this->success('登录成功', url('admin/Index/index'));
        } else {
            $this->error('用户名或密码错误');
        }
    }

    public function index()
    {
        return view();
    }

    public function edit($name)
    {
        $file = config('html.path') . DS . 'index' . DS . $name . '.html';
        if (!file_exists($file)) {
            return response('', 404);
        }
        $content = file_get_contents($file);
        return view('', compact('content'));
    }

    public function update($name)
    {
        $file = config('html.path') . DS . 'index' . DS . $name . '.html';
        if (!file_exists($file)) {
            return response('', 404);
        }
        $content = request()->put('content');
        file_put_contents($file, $content);
        return redirect($_SERVER['HTTP_REFERER']);
    }
}
