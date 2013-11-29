<?php namespace Special;

use Estate\Estate;
use User;

class SpecialPayment extends \Kareem3d\Eloquent\Model {

    /**
     * @var string
     */
    protected $table = 'special_payments';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offer()
    {
        return $this->belongsTo(SpecialOffer::getClass(), 'special_offer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::getClass(), 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estate()
    {
        return $this->belongsTo(Estate::getClass());
    }
}