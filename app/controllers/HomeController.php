<?php 

class HomeController extends BaseController {

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->page()->printMe();
    }
}