<?php

namespace app\mobile\controller;

use app\common\model\Post;

class Index
{
    public function index()
    {
        $content = view()->getContent();
        return $this->viewPjaxOrRead(compact('content'), true);
    }

    public function colleges()
    {
        $content = view()->getContent();
        return $this->viewPjaxOrRead(compact('content'), true);
    }

    public function read($id)
    {
        $post = Post::get('mobile', $id);
        if (!$post) {
            return response('', 404);
        }
        $content = $post->content;
        $content = preg_replace_callback('/<img.*?>/', function ($matches) {
            return preg_replace('/ src="(.+?)"/', ' data-original="$1"', $matches[0]);
        }, $content);
        return $this->viewPjaxOrRead(compact('content'), false);
    }

    public function viewPjaxOrRead($data, $is_raw = false)
    {
        $data['is_raw'] = $is_raw;
        if (request()->isPjax()) {
            return view('pjax', $data);
        }
        return view('read', $data);
    }
}
