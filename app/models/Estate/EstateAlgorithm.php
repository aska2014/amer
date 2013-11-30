<?php namespace Estate;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\App;

class EstateAlgorithm extends \Kareem3d\Eloquent\Algorithm {

    /**
     * @return $this
     */
    public function notAccepted()
    {
        $this->getQuery()->where('accepted', false);

        return $this;
    }

    /**
     * @return $this
     */
    public function accepted()
    {
        $this->getQuery()->where('accepted', true);

        return $this;
    }

    /**
     * @return $this
     */
    public function specials()
    {
        $ids = App::make('Special\SpecialAlgorithm')->current()->get(array('estate_id'));

        $this->getQuery()->whereIn('id', $ids->lists('estate_id'));

        return $this;
    }

    /**
     * @param EstateCategory $category
     * @return $this
     */
    public function underCategory(EstateCategory $category)
    {
        $this->getQuery()->where('estate_category_id', $category->id);

        foreach($category->children as $child)
        {
            $this->getQuery()->orWhere('estate_category_id', $child->id);
        }

        return $this;
    }

    /**
     * @return Builder
     */
    public function emptyQuery()
    {
        return Estate::query();
    }
}