<?php 

class HomeController extends BaseController {

    /**
     * @return mixed
     */
    public function index()
    {
        dd('asdf');
        return $this->page()->printMe();
    }
}