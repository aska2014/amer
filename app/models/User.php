<?php

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
    public function getCreatedEstates()
    {
        return $this->getRecipients(Estate::getClass());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getCreatedServices()
    {
        return $this->getRecipients(Service::getClass());
    }

    /**
     * @param Auction $auction
     * @return mixed
     */
    public function getCreatedAuctionOffers( Auction $auction )
    {
        return $this->auctionOffers()->where('auction_id', $auction->id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function auctionOffers()
    {
        return $this->hasMany(AuctionOffer::getClass());
    }
}