<?php

use Illuminate\Database\Query\Builder;

class EstateAlgorithm extends \Kareem3d\Eloquent\Algorithm {

    /**
     * @return $this
     */
    public function specials()
    {
        $this->getQuery()->where('special', true);

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