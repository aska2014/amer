<?php namespace Auction;

use Estate\Estate;
use Price;

class Auction extends \Kareem3d\Eloquent\Model {

    /**
     * @var array
     */
    protected $rules = array(
        'start_price' => 'required|numeric',
        'end_price' => 'required|numeric',
    );

    /**
     * @return Price
     */
    public function getHighestOfferPriceAttribute()
    {
        $offer = $this->getHighestAcceptedOffer();

        return $offer ? $offer->price : Price::make( 0 );
    }

    /**
     * @param $value
     * @return Price
     */
    public function getStartPriceAttribute( $value )
    {
        return Price::make($value);
    }

    /**
     * @param $value
     * @return Price
     */
    public function getEndPriceAttribute( $value )
    {
        return Price::make($value);
    }

    /**
     * Return the price this auction should start with.
     * Which is equal to the highest accepted offer price
     *
     * @return Price
     */
    public function calculateStartPrice()
    {
        $highestOffer = $this->getHighestAcceptedOffer();

        return $highestOffer ? $highestOffer->price : $this->start_price;
    }

    /**
     * @return AuctionOffer
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