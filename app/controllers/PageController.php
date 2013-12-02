<?php

use Website\Page;

class PageController extends BaseController {

    /**
     * @param Page $page
     * @return mixed
     */
    public function index(Page $page)
    {
        return $this->page()->printMe(compact('page'));
    }

}