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

    /**
     * Create link and attach to it after saving.
     *
     * @return mixed|void
     */
    public function afterSave()
    {
        // If link doesn't exist for this product then create new one..
        Link::getByPageAndModel('one-slider', $this) or Link::create(array(

            'relative_url' => $this->getSlug(),
            'page' => 'one-slider',
            'model' => $this
        ));
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return 'slider-' . $this->id . '.html';
    }

}