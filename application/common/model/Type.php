<?php

namespace app\common\model;

/**
 * Class Post
 *
 * @package app\common\model
 *
 * @property string $id readonly 文章类型id（PC端：index，移动端：mobile）
 * @property string $name readonly 文章类型名称
 * @property string $posts readonly 该类型所有文章
 */
class Type
{
    protected $id = null;
    protected $data = null;

    protected function __construct($id, $data)
    {
        $this->id = $id;
        $this->data = $data;
    }

    /**
     * 该类型所有文章
     *
     * @return array
     */
    public function posts()
    {
        return Post::allOfType($this->id);
    }

    /**
     * 获取 config('data.types')
     *
     * @return array
     */
    public static function getTypesData()
    {
        static $data = null;
        if (is_null($data)) {
            $data = config('data.types');
        }
        return $data;
    }

    /**
     * 获取全部文章类型
     *
     * @return array
     */
    public static function all()
    {
        $data = static::getTypesData();
        $result = [];
        foreach ($data as $id => $datum) {
            $result[] = new static($id, $datum);
        }
        return $result;
    }

    /**
     * 获取指定文章类型
     *
     * @param string $id 文章类型id
     *
     * @return null|static
     */
    public static function get($id)
    {
        $data = static::getTypesData();
        if (array_key_exists($id, $data)) {
            return new static($id, $data[$id]);
        }
        return null;
    }

    public function __get($name)
    {
        switch ($name) {
            case 'id':
                return $this->$name;
                break;
            case 'posts':
                return $this->posts();
                break;
            default:
                if (isset($this->data[$name])) {
                    return $this->data[$name];
                }
                throw new \Exception("Undefined property: " . static::class . "::$name");
                break;
        }
    }
}
