<?php

class Auction extends \Kareem3d\Eloquent\Model {

    /**
     * Return the price this auction should start with.
     * Which is equal to the highest accepted offer price
     *
     * @return float
     */
    public function calculateStartPrice()
    {
        return $this->getHighestAcceptedOffer()->price;
    }

    /**
     * @return StdClass
     */
    public function getHighestAcceptedOffer()
    {
        return $this->getAcceptedQuery()->orderBy('price', 'DESC')->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAcceptedOffers()
    {
        return $this->getAcceptedQuery()->get();
    }

    /**
     * @return boolean
     */
    public function hasAcceptedOffer()
    {
        return $this->getAcceptedQuery()->count() > 0;
    }

    /**
     * @return mixed
     */
    protected function getAcceptedQuery()
    {
        return $this->userOffers()->where('accepted', true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estate()
    {
        return $this->belongsTo(Estate::getClass());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function userOffers()
    {
        return $this->hasMany(AuctionOffer::getClass());
    }
}