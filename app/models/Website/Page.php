<?php namespace Website;

use Kareem3d\Eloquent\Model;

class Page extends Model {

    /**
     * @var string
     */
    protected $table = 'pages';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected static $specsTable = 'page_specs';

    /**
     * @var array
     */
    protected static $specs = array('title', 'body');

}