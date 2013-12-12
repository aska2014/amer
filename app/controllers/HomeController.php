<?php 

class HomeController extends BaseController {

    /**
     * @return mixed
     */
    public function dynamicIndex()
    {
        return $this->page()->printMe();
    }
}