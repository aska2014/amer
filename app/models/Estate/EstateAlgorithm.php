<?php namespace Estate;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Kareem3d\Eloquent\Model;

class EstateAlgorithm extends \Kareem3d\Eloquent\Algorithm {

    /**
     * @return $this
     */
    public function random()
    {
        $this->getQuery()->orderBy(DB::raw('rand()'));

        return $this;
    }

    /**
     * @return $this
     */
    public function orderBySpecial()
    {
        $this->getQuery()->leftJoin('specials', function($join)
        {
            $join->on('specials.estate_id', '=', 'estates.id')
                ->on('specials.from', '<', DB::raw('NOW()'))
                ->on('specials.to', '>', DB::raw('NOW()'));

        })->select(array('estate_specs.*', 'estates.*'))
            ->orderBy('specials.estate_id', 'DESC')
            ->orderBy('estates.id', 'DESC');

        return $this;
    }

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
        $this->getQuery()->join('specials', function($join)
        {
            $join->on('specials.estate_id', '=', 'estates.id')
                ->on('specials.from', '<', DB::raw('NOW()'))
                ->on('specials.to', '>', DB::raw('NOW()'));

        })->select(array('estate_specs.*', 'estates.*'));

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
     *
     */
    public function language()
    {
        $this->getQuery()->where('estate_specs.language', '=', App::make('Language')->get());

        return $this;
    }

    /**
     * @return Builder
     */
    public function emptyQuery()
    {
        return Estate::join('estate_specs', 'estate_specs.estate_id', '=', 'estates.id')
                      ->select(array('estate_specs.*', 'estates.*'));
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