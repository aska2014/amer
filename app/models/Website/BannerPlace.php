<?php namespace Website;

use Kareem3d\Eloquent\Model;

class BannerPlace extends Model {

    /**
     * @var string
     */
    protected $table = 'banner_places';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param $size
     * @return bool
     */
    public function isSize( $size )
    {
        if(strpos($size, 'px') === false)
        {
            $size = explode('x', $size);

            return count($size) > 1 && $size[0] == $this->width && $size[1] == $this->height;
        }

        return $this->size == $size;
    }

    /**
     * @return string
     */
    public function getSizeAttribute()
    {
        return "{$this->width}px x {$this->height}px";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requests()
    {
        return $this->hasMany(BannerRequest::getClass());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function banners()
    {
        return $this->hasMany(Banner::getClass());
    }

}