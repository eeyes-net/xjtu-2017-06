<?php

namespace app\admin\controller;

use think\Controller;
use think\exception\HttpResponseException;
use think\Session;

class Login extends Controller
{
    protected $beforeActionList = [
        'mustGuest' => ['except' => 'logout'],
    ];

    protected function mustGuest()
    {
        if (Session::get('is_login')) {
            throw new HttpResponseException(redirect('admin/Index/index'));
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
            return redirect('admin/Index/index');
        } else {
            Session::flash('login_failed', true);
            Session::flash('username', $username);
            return redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function logout()
    {
        Session::delete('is_login');
        return redirect('admin/Login/loginForm');
    }
}
