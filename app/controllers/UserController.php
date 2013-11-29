<?php 

class UserController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    /**
     * @return mixed
     */
    public function estates()
    {
        $estatesTitle = trans('words.my_estates');

        $estates = Auth::user()->estates;

        return $this->page()->printMe(compact('estatesTitle', 'estates'));
    }
}