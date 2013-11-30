<?php 

class UserController extends BaseController {

    const ESTATES_PER_PAGE = 8;

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

        $estates = $this->estatesAlgorithm->byUser(Auth::user())->orderByDate()->paginate(self::ESTATES_PER_PAGE);

        return $this->page()->printMe(compact('estatesTitle', 'estates'));
    }
}