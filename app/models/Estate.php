<?php

use Illuminate\Support\Str;
use Kareem3d\Link\Link;

class Estate extends \Kareem3d\Eloquent\Model {

    const FOR_SALE = 'for-sale';
    const FOR_RENT = 'for-rent';
    const PURCHASE = 'purchase';
    const AUCTION = 'auction';

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
    protected static $specs = array( 'title', 'city', 'region', 'description' );

    /**
     * @var array
     */
    protected $rules = array(
        'title' => 'required',
        'city' => 'required',
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
     * Get estate service types...
     *
     * @return array
     */
    public function getTypes()
    {
        return array(
            self::FOR_SALE,
            self::FOR_RENT,
            self::PURCHASE,
            self::AUCTION
        );
    }

    /**
     * @param $value
     * @return string
     */
    public function getPriceAttribute( $value )
    {
        return $this->getCurrentLanguage() === 'en' ? new Price($value, 'EGP') : new Price($value, 'جنيه', 'value currency');
    }

    /**
     * Create link and attach to it after saving.
     *
     * @return mixed|void
     */
    public function afterSave()
    {
        // If link doesn't exist for this estate then create new one..
        Link::getByPageAndModel('one-estate', $this) or Link::create(array(

            'relative_url' => $this->getSlug(),
            'page' => 'one-estate',
            'model' => $this
        ));
    }

    /**
     * @return bool|null|void
     */
    public function delete()
    {
        $link = Link::getByPageAndModel('one-estate', $this);

        $link and $link->delete();

        return parent::delete();
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return rtrim($this->category->getSlug(), '.html') . '/estate-' . $this->id . '.html';
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
    public function getUserAttribute()
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
        return $this->belongsTo(EstateCategory::getClass(), 'estate_category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function auction()
    {
        return $this->hasOne(Auction::getClass());
    }
}