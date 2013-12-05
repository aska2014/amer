<?php namespace Website;

use Kareem3d\Eloquent\Model;

class Banner extends Model {

    /**
     * @var array
     */
    protected $extensions = array('Images');

    /**
     * @var string
     */
    protected $table = 'banners';

    /**
     * @var bool
     */
    public $timestamps = false;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(BannerPlace::getClass(), 'banner_place_id');
    }
}