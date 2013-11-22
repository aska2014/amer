<?php

use Illuminate\Support\Str;
use Kareem3d\Link\Link;

class Estate extends \Kareem3d\Eloquent\Model {

    const FOR_SALE = 0;
    const FOR_RENT = 1;
    const FOR_BUY = 2;
    const AUCTION = 3;

    /**
     * @var array
     */
    protected $extensions = array('Images');

    /**
     * @var string
     */
    protected static $specsTable = 'estate_specs';

    /**
     * @var array
     */
    protected static $specs = array( 'title', 'place', 'region', 'description' );

    /**
     * @var array
     */
    protected $rules = array(
        'title' => 'required',
        'place' => 'required',
        'region' => 'required',
        'estate_category_id' => 'required|exists:estate_categories,id',
        'number_of_rooms' => 'required|integer',
        'type' => 'required|in:0,1,2'
    );

    /**
     * Create link and attach to it after saving.
     *
     * @return mixed|void
     */
    public function afterSave()
    {
        // If link doesn't exist for this product then create new one..
        Link::getByPageAndModel('one-estate', $this) or Link::create(array(

            'relative_url' => $this->getSlug(),
            'page' => 'one-estate',
            'model' => $this
        ));
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return Str::slug(Str::words($this->en('title'), 3, ''));
    }

    /**
     * @return array
     */
    public function getTypes()
    {
        return array(

            self::FOR_SALE => 'للبيع',
            self::FOR_RENT => 'للإيجار',
            self::FOR_BUY => 'للشراء',
            self::AUCTION => 'المزاد',
        );
    }

    /**
     * @return bool
     */
    public function forBuy()
    {
        return $this->type == static::FOR_BUY;
    }

    /**
     * @return bool
     */
    public function forRent()
    {
        return $this->type == static::FOR_RENT;
    }

    /**
     * @return bool
     */
    public function forSale()
    {
        return $this->type == static::FOR_SALE;
    }

    /**
     * @return bool
     */
    public function hasAuction()
    {
        // If it's for sale or for rent and has an auction attached to it
        return ($this->forSale() or $this->forRent()) and $this->auction()->count() > 0;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getUser()
    {
        return User::getByCreation( $this )->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ownerInfo()
    {
        return $this->belongsTo(UserInfo::getClass(), 'owner_info_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(EstateCategory::getClass());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function auction()
    {
        return $this->hasOne(Auction::getClass());
    }
}