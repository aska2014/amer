<?php

use Kareem3d\Link\Link;

class News extends \Kareem3d\Eloquent\Model {

    /**
     * @var string
     */
    protected $table = 'news';

    /**
     * @var array
     */
    protected $extensions = array('Images');

    /**
     * @var string
     */
    protected static $specsTable = 'news_specs';

    /**
     * @var array
     */
    protected static $specs = array('title' , 'description');

    /**
     * @return News
     */
    public static function getRandomLatest($num)
    {
        return static::orderBy('created_at', 'DESC')->take($num)->get();
    }
}