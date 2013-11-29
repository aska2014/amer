<?php namespace Estate;

use Auction\Auction;
use Illuminate\Support\Str;
use Kareem3d\Link\Link;
use Price;
use Special\Special;
use Special\SpecialPayment;
use User;
use UserInfo;

class Estate extends \Kareem3d\Eloquent\Model {

    /**
     * @var array
     */
    protected $extensions = array('Images', 'Acceptable');

    /**
     * @var string
     */
    protected static $specsTable = 'estate_specs';

    /**
     * @var array
     */
    protected static $specs = array( 'title', 'city', 'region', 'description' );

    /**
     * @var array
     */
    protected $rules = array(
        'title' => 'required',
        'city' => 'required',
        'price' => 'required|numeric',
        'region' => 'required',
        'estate_category_id' => 'required|exists:estate_categories,id',
        'number_of_rooms' => 'required|integer',
    );

    /**
     * @var array
     */
    protected $arCustomMessages = array(
        'title.required' => 'يجب إدخال عنوان العقار',
        'city.required' => 'يجب إدخال المدينة',
        'region.required' => 'يجد إدخال الحى او المنطقة',
        'estate_category_id.required' => 'يجب إختيار نوع العقار',
        'estate_category_id.exists' => 'يجب إختيار نوع العقار',
        'number_of_rooms.required' => 'يجب إدخال عدد الغرف',
        'number_of_rooms.integer' => 'يجب إدخال عدد الغرف',
    );

    /**
     * @var array
     */
    protected $enCustomMessages = array(
        'title.required' => '',
        'city.required' => '',
        'region.required' => '',
        'estate_category_id.required' => '',
        'estate_category_id.exists' => '',
        'number_of_rooms.required' => '',
        'number_of_rooms.integer' => '',
        'type.required' => ''
    );

    /**
     * @param $type
     */
    public function getImage($type)
    {
        $image = parent::getImage($type);

        return $image->exists ? $image : parent::getImage('estate-default');
    }

    /**
     * @return bool
     */
    public function hasPayments()
    {
        return $this->specialPayments()->count() > 0;
    }

    /**
     * @param $value
     * @return string
     */
    public function getPriceAttribute( $value )
    {
        if(! $value && $this->auction) return $this->auction->start_price;

        return Price::make($value);
    }

    /**
     * @return bool
     */
    public function hasAuction()
    {
        // If it's for sale or for rent and has an auction attached to it
        return $this->auction()->count() > 0;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::getClass());
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
        return $this->belongsTo(EstateCategory::getClass(), 'estate_category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function auction()
    {
        return $this->hasOne(Auction::getClass());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specialPayments()
    {
        return $this->hasMany(SpecialPayment::getClass());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function special()
    {
        return $this->hasOne(Special::getClass());
    }
}