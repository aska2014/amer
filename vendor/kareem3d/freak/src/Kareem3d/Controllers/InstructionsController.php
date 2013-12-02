<?php namespace Kareem3d\Controllers;

class InstructionsController {

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return View::make('freak::instructions.website');
    }

}