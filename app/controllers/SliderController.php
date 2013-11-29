<?php 

class SliderController extends BaseController {

    /**
     * @return mixed
     */
    public function show()
    {
        return $this->page()->printMe(array(

            'slider' => $this->link()->getModelOrFail()
        ));
    }

}