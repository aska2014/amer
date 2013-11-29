<?php namespace Special;

use Illuminate\Support\Facades\Lang;

class SpecialOffer extends \Kareem3d\Eloquent\Model {

    const MONTH = 'month';
    const YEAR = 'year';
    const DAY = 'day';
    const WEEK = 'week';

    /**
     * @var string
     */
    protected $table = 'special_offers';

    /**
     * @var array
     */
    protected $rules = array(
        // Duration are in hours
        'duration_period' => 'required|integer',
        'duration_type' => 'required',
        'price'    => 'required|numeric',
    );

    /**
     * @return string
     */
    public function getTranslatedDuration()
    {
        return Lang::choice("date.{$this->duration_type}", $this->duration_period, array(
            'count' => $this->duration_period
        ));
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getPriceAttribute( $value )
    {
        return \Price::make($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specialPayments()
    {
        return $this->hasMany(SpecialPayment::getClass());
    }
}