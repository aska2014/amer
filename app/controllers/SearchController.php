<?php

use Estate\EstateAlgorithm;

class SearchController extends BaseController {

    /**
     * @var Estate\EstateAlgorithm
     */
    protected $estatesAlgorithm;

    /**
     * @param EstateAlgorithm $estatesAlgorithm
     */
    public function __construct(EstateAlgorithm $estatesAlgorithm)
    {
        $this->estatesAlgorithm = $estatesAlgorithm;
    }

    /**
     * @return mixed
     */
    public function dynamicIndex()
    {
        $this->searchByCategory();

        $this->searchByPlace();

        $this->searchByArea();

        $this->searchByPrice();

        $estates = $this->estatesAlgorithm->language()->accepted()->orderBySpecial()->orderByDate()->paginate(EstateController::ESTATES_PER_PAGE);

        $estatesTitle = trans('titles.search_result');

        return $this->page()->printMe(compact('estates', 'estatesTitle'));
    }

    /**
     * @return mixed
     */
    protected function searchByCategory()
    {
        if($search = Input::get('search_category'))
        {
            $this->estatesAlgorithm->byCategory($search);
        }
    }

    /**
     * @return mixed
     */
    protected function searchByPlace()
    {
        if($search = Input::get('search_province'))
        {
            $this->estatesAlgorithm->byProvince($search);
        }

        if($search = Input::get('search_city'))
        {
            $this->estatesAlgorithm->byCity($search);
        }

        if($search = Input::get('search_region'))
        {
            $this->estatesAlgorithm->byRegion($search);
        }
    }

    /**
     * @return mixed
     */
    protected function searchByArea()
    {
        if($search = Input::get('search_area_low'))
        {
            $this->estatesAlgorithm->areaGreaterThan($search);
        }

        if($search = Input::get('search_area_high'))
        {
            $this->estatesAlgorithm->areaLessThan($search);
        }
    }

    /**
     * @return mixed
     */
    protected function searchByPrice()
    {
        if($search = Input::get('search_price_low'))
        {
            $this->estatesAlgorithm->priceGreaterThan($search);
        }

        if($search = Input::get('search_price_high'))
        {
            $this->estatesAlgorithm->priceLessThan($search);
        }
    }

}