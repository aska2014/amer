<?php 

class UserController extends BaseController {

    /**
     * @var Estate\EstateAlgorithm
     */
    protected $estatesAlgorithm;

    /**
     * @param \Estate\EstateAlgorithm $estatesAlgorithm
     */
    public function __construct(\Estate\EstateAlgorithm $estatesAlgorithm)
    {
        $this->beforeFilter('auth');

        $this->estatesAlgorithm = $estatesAlgorithm;
    }

    /**
     * @return mixed
     */
    public function estates()
    {
        $estatesTitle = trans('titles.my_estates');

        $estates = $this->estatesAlgorithm->byUser(Auth::user())->orderByDate()->get();

        return $this->page()->printMe(compact('estatesTitle', 'estates'));
    }
}