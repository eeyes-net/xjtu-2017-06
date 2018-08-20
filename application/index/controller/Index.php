<?php

namespace app\index\controller;

use app\common\model\Post;
use think\Cookie;

class Index
{
    public function index()
    {
        if (is_mobile() && !Cookie::get('redirected')) {
            Cookie::set('redirected', true, [
                'expire' => '300',
            ]);
            return redirect('mobile/Index/index');
        }
        return $this->read(array_keys(config('data.menu_index'))[0]);
    }

    public function colleges()
    {
        return $this->read(Post::allCollegeOfType('index')[0]->id);
    }

    public function read($id)
    {
        $post = Post::get('index', $id);
        if (!$post) {
            return response('', 404);
        }
        $title = $post->title;
        return $this->viewPjaxOrRead(compact('post', 'title'));
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
