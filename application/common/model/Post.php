<?php

namespace app\common\model;

/**
 * Class Post
 *
 * @package app\common\model
 *
 * @property Type $type readonly 文章类型
 * @property string $id readonly ID
 * @property string $name readonly 文章名称
 * @property string $content 文章内容
 */
class Post
{
    protected $type = null;
    protected $id = null;
    protected $name = null;
    protected $content = null;

    protected function __construct($type, $id, $name)
    {
        $this->type = $type;
        $this->id = $id;
        $this->name = $name;
    }

    public static function getPostsData()
    {
        static $data = null;
        if (is_null($data)) {
            $data = config('data.posts');
        }
        return $data;
    }

    public static function allOfType($type_id)
    {
        $type = Type::get($type_id);
        $result = [];
        if ($type) {
            $data = static::getPostsData()[$type_id];
            foreach ($data as $id => $datum) {
                $result[] = new static($type, $id, $datum['name']);
            }
        }
        return $result;
    }

    public static function get($type_id, $id)
    {
        $type = Type::get($type_id);
        if (!$type) {
            return null;
        }
        $data = static::getPostsData()[$type_id];
        if (array_key_exists($id, $data)) {
            return new static($type, $id, $data[$id]['name']);
        }
    }

    protected function getFilePath()
    {
        return config('html.path') . DS . $this->type->id . DS . $this->id . '.html';
    }

    public function getContent()
    {
        if (is_null($this->content)) {
            $file_path = $this->getFilePath();
            $this->content = file_exists($file_path) ? file_get_contents($file_path) : '（暂无内容）';
        }
        return $this->content;
    }

    public function save()
    {
        return file_put_contents($this->getFilePath(), $this->content);
    }

    public function __get($name)
    {
        switch ($name) {
            case 'type':
            case 'id':
            case 'name':
                return $this->$name;
                break;
            case 'content':
                return $this->getContent();
                break;
            default:
                throw new \Exception("Undefined property: Post::$name");
                break;
        }
    }

    public function __set($name, $value)
    {
        switch ($name) {
            case 'type':
            case 'id':
            case 'name':
                throw new \Exception("Change readonly property: " . static::class . "::$name");
                break;
            case'content':
                $this->content = $value;
                break;
            default:
                throw new \Exception("Undefined property: " . static::class . "::$name");
                break;
        }
    }
}
