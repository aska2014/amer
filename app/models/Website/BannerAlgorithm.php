<?php
namespace Website;


use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Kareem3d\Eloquent\Algorithm;

class BannerAlgorithm extends Algorithm {

    /**
     * @return $this
     */
    public function active()
    {
        $this->getQuery()->where('from', '<', DB::raw('NOW()'))->where('to', '>', DB::raw('NOW()'));

        return $this;
    }

    /**
     * @param $name
     * @return $this
     */
    public function place($name)
    {
        $this->getQuery()
            ->join('banner_places', 'banner_places.id', '=', 'banners.banner_place_id')
            ->where('banner_places.name', $name)
            ->select(array('banners.*'));

        return $this;
    }

    /**
     * @return $this
     */
    public function recent()
    {
        $this->getQuery()->orderBy('id', 'DESC');

        return $this;
    }

    /**
     * @return Builder
     */
    public function emptyQuery()
    {
        return Banner::query();
    }
}