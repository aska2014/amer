<?php

use Auction\AuctionOffer;
use Estate\Estate;
use Kareem3d\Membership\User as Kareem3dUser;

class User extends Kareem3dUser {

    /**
     * @var array
     */
    protected $arCustomMessages = array(
        'email.required' => 'يجب إدخال الإيميل',
        'email.email' => 'يجب إدخال إيميل صحيح',
        'email.unique' => 'هذا الإيميل موجود من قبل',
        'password.required' => 'يجب إدخال كلمة السر',
        'password.regex' => 'يجب ان تكون كلمة السر بالحروة الأجنبية وبها على الأقل رقم.'
    );

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estates()
    {
        return $this->hasMany(Estate::getClass());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auctionOffers()
    {
        return $this->hasMany(AuctionOffer::getClass());
    }
}