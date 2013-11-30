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
        $this->getQuery()->where('from', '<', DB::raw('NOW()'))->where('to', '>', DB::raw('NOW()'));

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