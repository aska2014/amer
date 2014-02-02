<?php namespace Special;

use Estate\Estate;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Kareem3d\Eloquent\Algorithm;

class SpecialAlgorithm extends Algorithm {

    /**
     * @return $this
     */
    public function current()
    {
        $now = date('Y-m-d H:i:s');

        $this->getQuery()->where('from', '<=', $now)->where('to', '>=', $now);

        return $this;
    }

    /**
     * @param Estate $estate
     * @return $this
     */
    public function estate(Estate $estate)
    {
        $this->getQuery()->where('estate_id', $estate->id);

        return $this;
    }


    /**
     * @return Builder
     */
    public function emptyQuery()
    {
        return Special::query();
    }
}