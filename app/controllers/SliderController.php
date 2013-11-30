<?php 

class SliderController extends BaseController {

    /**
     * @param Slider $slider
     * @return mixed
     */
    public function show(Slider $slider)
    {
        return $this->page()->printMe(array(

            'slider' => $slider
        ));
    }

}