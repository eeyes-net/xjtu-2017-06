<?php

namespace app\mobile\controller;

use app\common\model\Post;

class Index
{
    public function index()
    {
        $content = view()->getContent();
        return $this->viewPjaxOrRead(compact('content'));
    }

    public function colleges()
    {
        $content = view()->getContent();
        return $this->viewPjaxOrRead(compact('content'));
    }

    public function read($id)
    {
        $post = Post::get('mobile', $id);
        if (!$post) {
            return response('', 404);
        }
        return $this->viewPjaxOrRead(compact('post'));
    }

    public function viewPjaxOrRead($data) {
        if (request()->isPjax()) {
            return view('pjax', $data);
        }
        return view('read', $data);
    }
}
