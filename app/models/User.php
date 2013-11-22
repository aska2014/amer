<?php

use Kareem3d\Membership\User as Kareem3dUser;

class User extends Kareem3dUser {

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