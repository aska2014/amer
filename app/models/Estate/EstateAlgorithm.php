<?php namespace Estate;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\App;
use Kareem3d\Eloquent\Model;

class EstateAlgorithm extends \Kareem3d\Eloquent\Algorithm {

    /**
     * @param $city
     * @return $this
     */
    public function byCity($city)
    {
        $this->getQuery()->where('estate_specs.city', 'like', '%'.$city.'%');

        return $this;
    }

    /**
     * @param $region
     * @return $this
     */
    public function byRegion($region)
    {
        $this->getQuery()->where('estate_specs.region', 'like', '%'.$region.'%');

        return $this;
    }

    /**
     * @param $area
     * @return $this
     */
    public function areaGreaterThan($area)
    {
        $this->getQuery()->where('estates.area', '>=', $area);

        return $this;
    }

    /**
     * @param $area
     * @return $this
     */
    public function areaLessThan($area)
    {
        $this->getQuery()->where('estates.area', '<=', $area);

        return $this;
    }

    /**
     * @param $price
     * @return $this
     */
    public function priceGreaterThan($price)
    {
        $this->getQuery()->where('estates.price', '>=', $price);

        return $this;
    }

    /**
     * @param $price
     * @return $this
     */
    public function priceLessThan($price)
    {
        $this->getQuery()->where('estates.price', '<=', $price);

        return $this;
    }

    /**
     * @param $province
     * @return $this
     */
    public function byProvince($province)
    {
        $this->getQuery()->where('estates.province_id', $this->extractId($province));

        return $this;
    }

    /**
     * @param $category
     * @return $this
     */
    public function byCategory($category)
    {
        $this->getQuery()->where('estates.estate_category_id', $this->extractId($category));

        return $this;
    }

    /**
     * @param $user
     * @return $this
     */
    public function byUser( $user )
    {
        $this->getQuery()->where('estates.user_id', $this->extractId($user));

        return $this;
    }

    /**
     * @return $this
     */
    public function notAccepted()
    {
        $this->getQuery()->where('estates.accepted', false);

        return $this;
    }

    /**
     * @return $this
     */
    public function accepted()
    {
        $this->getQuery()->where('estates.accepted', true);

        return $this;
    }

    /**
     * @return $this
     */
    public function specials()
    {
        $ids = App::make('Special\SpecialAlgorithm')->current()->get(array('estate_id'));

        $estates_ids = $ids->lists('estate_id');

        if(empty($estates_ids))
        {
            $this->getQuery()->where('estates.id', 0);
        }
        else
        {
            $this->getQuery()->whereIn('estates.id', $ids->lists('estate_id'));
        }

        return $this;
    }

    /**
     * @param EstateCategory $category
     * @return $this
     */
    public function underCategory(EstateCategory $category)
    {
        $this->getQuery()->where(function( $query ) use ($category)
        {
            $query->where('estates.estate_category_id', $category->id);

            foreach($category->children as $child)
            {
                $query->orWhere('estates.estate_category_id', $child->id);
            }
        });

        return $this;
    }

    /**
     * @return Builder
     */
    public function emptyQuery()
    {
        return Estate::join('estate_specs', 'estate_specs.estate_id', '=', 'estates.id');
    }

    /**
     * @param $model
     * @return mixed
     */
    protected function extractId( $model )
    {
        return $model instanceof Model ? $model->id : $model;
    }
}