<?php

namespace app\common\model;

/**
 * Class Post
 *
 * @package app\common\model
 *
 * @property string $id readonly 类型（PC端：index，移动端：mobile）
 * @property string $name readonly 类型对应的名称
 * @property string $posts readonly 该类型所有文章
 */
class Type
{
    protected $id = null;
    protected $name = null;

    protected function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function posts()
    {
        return Post::allOfType($this->id);
    }

    public static function getTypesData()
    {
        static $data = null;
        if (is_null($data)) {
            $data = config('data.types');
        }
        return $data;
    }

    public static function all()
    {
        $data = static::getTypesData();
        $result = [];
        foreach ($data as $id => $datum) {
            $result[] = new static($id, $datum['name']);
        }
        return $result;
    }

    public static function get($id)
    {
        $data = static::getTypesData();
        if (array_key_exists($id, $data)) {
            return new static($id, $data[$id]['name']);
        }
        return null;
    }

    public function __get($name)
    {
        switch ($name) {
            case 'id':
            case 'name':
                return $this->$name;
                break;
            case 'posts':
                return $this->posts();
                break;
            default:
                throw new \Exception("Undefined property: " . static::class . "::$name");
                break;
        }
    }
}
