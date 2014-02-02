<?php namespace Estate;

use Auction\Auction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Kareem3d\Eloquent\Model;
use Kareem3d\Images\Image;
use Place\Province;
use Price;
use Special\Special;
use Special\SpecialOffer;
use Special\SpecialPayment;
use User;
use UserInfo;

class Estate extends Model {

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
        'province_id' => 'required|exists:provinces,id',
        'price' => 'required|numeric',
        'region' => 'required',
        'estate_category_id' => 'required|exists:estate_categories,id',
        'number_of_rooms' => 'integer',
    );

    /**
     * @var array
     */
    protected $arCustomMessages = array(
        'title.required' => 'يجب إدخال عنوان العقار',
        'provinces.required' => 'يجب إدخال المحافظة',
        'region.required' => 'يجد إدخال الحى او المنطقة',
        'estate_category_id.required' => 'يجب إختيار نوع العقار',
        'estate_category_id.exists' => 'يجب إختيار نوع العقار',
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
     * @return mixed|void
     */
    public function beforeValidate()
    {
        // If there's child for this estate category then set it to this estate_category_id
        if($id = EstateCategory::getFirstChildrenId($this->estate_category_id))
        {
            $this->estate_category_id = $id;
        }

        $this->cleanXSS();
    }

    /**
     * @return Collection|null
     */
    public function getIfHasGalleryImages()
    {
        $images = $this->getImages('gallery');

        return $images->isEmpty() ? null : $images;
    }

    /**
     * @param $value
     */
    public function setAreaAttribute( $value )
    {
        $this->attributes['area'] = trim(str_replace('م', '', $value));
        $this->attributes['area'] = trim(str_replace('m', '', $this->attributes['area']));
    }

    /**
     * @return int
     */
    public function getNumberOfViews()
    {
        return $this->number_of_views ?: 0;
    }

    /**
     * This will increment the number of views by one and push it to the database
     */
    public function incrementViews()
    {
        $this->number_of_views ++;

        $this->save();
    }

    /**
     * @return SpecialPayment
     */
    public function getLastPayment()
    {
        return $this->specialPayments()->orderBy('created_at', 'DESC')->first();
    }

    /**
     * @param $from
     * @param $to
     */
    public function makeSpecial($from, $to)
    {
        $this->specials()->delete();

        dd($from, $to);

        $this->specials()->create(compact('from' ,'to'));
    }

    /**
     * @return SpecialOffer|null
     */
    public function getActiveSpecial()
    {
        return App::make('Special\SpecialAlgorithm')->estate($this)->current()->first();
    }

    /**
     * @return bool
     */
    public function isSpecial()
    {
        return App::make('Special\SpecialAlgorithm')->estate($this)->current()->count() > 0;
    }

    /**
     * @param $type
     */
    public function getImage($type = '')
    {
        $image = parent::getImage($type);

        return $image->exists() ? $image : Image::where('type', 'estate-default-' . $this->getCurrentLanguage())->first();
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
     * @param $value
     * @return \Area
     */
    public function getAreaAttribute( $value )
    {
        return \Area::make($value, trans('units.metre'));
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specials()
    {
        return $this->hasMany(Special::getClass());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::getClass());
    }

    /**
     * @return int
     */
    public function getNumberOfComments()
    {
        return $this->comments()->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(\Comment::getClass(), 'commentable');
    }
}