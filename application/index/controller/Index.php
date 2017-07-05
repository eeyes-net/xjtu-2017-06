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
            return redirect(url('mobile/Index/index'));
        }
        return $this->read('introduction');
    }

    public function read($id)
    {
        $post = Post::get('index', $id);
        if (!$post) {
            return response('', 404);
        }
        if (request()->isPjax()) {
            return view('pjax', compact('post'));
        }
        return view('read', compact('post'));
    }

    public function colleges()
    {
        return $this->read(Post::allCollegeOfType('index')[0]->id);
    }
}
