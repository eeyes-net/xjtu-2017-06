<?php

namespace app\common\model;

/**
 * Class Post
 *
 * @package app\common\model
 *
 * @property Type $type readonly 文章类型
 * @property string $id readonly 文章id
 * @property string $name readonly 文章名称
 * @property string $content 文章内容
 * @property string $title 文章标题
 */
class Post
{
    protected $type = null;
    protected $id = null;
    protected $data = null;
    protected $content = null;

    protected function __construct($type, $id, $data)
    {
        $this->type = $type;
        $this->id = $id;
        $this->data = $data;
    }

    /**
     * 获取 config('data.posts')
     *
     * @return array
     */
    public static function getPostsData()
    {
        static $data = null;
        if (is_null($data)) {
            $data = config('data.posts');
        }
        return $data;
    }

    /**
     * 获取 config('data.college_ids')
     *
     * @return array
     */
    public static function getCollegeIds()
    {
        static $college_ids = null;
        if (is_null($college_ids)) {
            $college_ids = config('data.college_ids');
        }
        return $college_ids;
    }

    /**
     * 获取指定类型的所有文章
     *
     * @param string $type_id 文章类型id
     *
     * @return array
     */
    public static function allOfType($type_id)
    {
        $type = Type::get($type_id);
        $result = [];
        if ($type) {
            $data = static::getPostsData()[$type_id];
            foreach ($data as $id => $datum) {
                $result[] = new static($type, $id, $datum);
            }
        }
        return $result;
    }

    /**
     * 获取指定类型所有书院文章
     *
     * @param string $type_id 文章类型id
     *
     * @return array
     */
    public static function allCollegeOfType($type_id)
    {
        $type = Type::get($type_id);
        $result = [];
        if ($type) {
            $data = static::getPostsData()[$type_id];
            foreach (static::getCollegeIds() as $id) {
                if (array_key_exists($id, $data)) {
                    $result[] = new static($type, $id, $data[$id]);
                }
            }
        }
        return $result;
    }

    /**
     * 获取指定类型、指定id文章
     *
     * @param string $type_id 文章类型id
     * @param string $id 文章id
     *
     * @return null|static
     */
    public static function get($type_id, $id)
    {
        $type = Type::get($type_id);
        if (!$type) {
            return null;
        }
        $data = static::getPostsData()[$type_id];
        if (array_key_exists($id, $data)) {
            return new static($type, $id, $data[$id]);
        }
    }

    /**
     * 获取本地文件路径
     *
     * @return string
     */
    protected function getFilePath()
    {
        return config('data.html_path') . DS . $this->type->id . DS . $this->id . '.html';
    }

    /**
     * 获取内容（惰性加载）
     *
     * @return bool|string
     */
    public function getContent()
    {
        if (is_null($this->content)) {
            $file_path = $this->getFilePath();
            $this->content = file_exists($file_path) ? file_get_contents($file_path) : '（暂无内容）';
        }
        return $this->content;
    }

    /**
     * 保存文章
     *
     * @return bool|int
     */
    public function save()
    {
        return file_put_contents_auto_mkdir($this->getFilePath(), $this->content);
    }

    /**
     * 是否是书院
     *
     * @return bool
     */
    public function isCollege()
    {
        return in_array($this->id, static::getCollegeIds());
    }

    public function getTitle()
    {
        return $this->data['name'];
    }

    public function __get($name)
    {
        switch ($name) {
            case 'type':
            case 'id':
                return $this->$name;
                break;
            case 'content':
                return $this->getContent();
                break;
            case 'title':
                return $this->getTitle();
                break;
            default:
                if (isset($this->data[$name])) {
                    return $this->data[$name];
                }
                throw new \Exception("Undefined property: Post::$name");
                break;
        }
    }

    public function __set($name, $value)
    {
        switch ($name) {
            case 'type':
            case 'id':
            case 'data':
            case 'title':
                throw new \Exception("Change readonly property: " . static::class . "::$name");
                break;
            case 'content':
                $this->content = $value;
                break;
            default:
                throw new \Exception("Undefined property: " . static::class . "::$name");
                break;
        }
    }
}
