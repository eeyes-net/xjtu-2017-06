<?php

namespace app\admin\controller;

use app\common\model\Post;
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

    public function edit($type_id, $id)
    {
        $post = Post::get($type_id, $id);
        if (!$post) {
            $this->error('文件不存在');
        }
        return view('', compact('post'));
    }

    public function update($type_id, $id)
    {
        $post = Post::get($type_id, $id);
        if (!$post) {
            $this->error('文件不存在');
        }
        $post->content = request()->put('content');
        $post->save();
        Session::flash('save_ok', '文件保存成功');
        return redirect($_SERVER['HTTP_REFERER']);
    }
}
