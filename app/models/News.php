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
     * Create link and attach to it after saving.
     *
     * @return mixed|void
     */
    public function afterSave()
    {
        // If link doesn't exist for this product then create new one..
        Link::getByPageAndModel('one-news', $this) or Link::create(array(

            'relative_url' => $this->getSlug(),
            'page' => 'one-news',
            'model' => $this
        ));
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return Str::slug(Str::words($this->en('title'), 3, ''));
    }

}