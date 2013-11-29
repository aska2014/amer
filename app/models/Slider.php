<?php

use Kareem3d\Link\Link;

class Slider extends \Kareem3d\Eloquent\Model {

    /**
     * @var string
     */
    protected $table = 'sliders';

    /**
     * @var array
     */
    protected $extensions = array('Images');

    /**
     * @var string
     */
    protected static $specsTable = 'slider_specs';

    /**
     * @var array
     */
    protected static $specs = array('title' , 'small_description', 'large_description');

}