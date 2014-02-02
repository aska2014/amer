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
        $now = date('Y-m-d H:i:s');

        $this->getQuery()->where('from', '<=', $now)->where('to', '>=', $now);

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