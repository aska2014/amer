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

        $this->beforeFilter('auth');
    }

    /**
     * @return mixed
     */
    public function dynamicEstates()
    {
        $estatesTitle = trans('titles.my_estates');

        $estates = $this->estatesAlgorithm->byUser(Auth::user())->language()->orderByDate()->paginate(EstateController::ESTATES_PER_PAGE);

        return $this->page()->printMe(compact('estatesTitle', 'estates'));
    }

    /**
     * @return mixed
     */
    public function dynamicBookmarks()
    {
        $estatesTitle = trans('titles.my_bookmarks');

        $estates = $this->estatesAlgorithm->bookmarks(Auth::user())->language()->orderByDate()->paginate(EstateController::ESTATES_PER_PAGE);

        return $this->page()->printMe(compact('estatesTitle', 'estates'));
    }
}