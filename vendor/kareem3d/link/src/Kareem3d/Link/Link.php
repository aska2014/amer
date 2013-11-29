<?php namespace Kareem3d\Link;

use Kareem3d\Eloquent\Model;
use Kareem3d\Templating\Page;

interface Link {

    /**
     * @return string
     */
    public function getPageName();

    /**
     * @return Page
     */
    public function getPage();

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @return Model
     */
    public function getModel();

}