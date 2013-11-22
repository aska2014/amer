<?php 

class AuctionOffer extends \Kareem3d\Eloquent\Model {

    /**
     * @var string
     */
    protected $table = 'auction_offers';

    /**
     * @param User $user
     * @param Auction $auction
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getByUserAndAuction( User $user, Auction $auction )
    {
        return static::where('user_id', $user->id)->where('auction_id', $auction->id)->get();
    }

    /**
     * @param Auction $auction
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getByAuction(Auction $auction)
    {
        return static::where('auction_id', $auction->id)->get();
    }

    /**
     * @param Auction $auction
     */
    public function setAuctionAttribute(Auction $auction)
    {
        $this->auction_id = $auction->id;
    }

    /**
     * @param User $user
     */
    public function setUserAttribute( User $user )
    {
        $this->user_id = $user->id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auction()
    {
        return $this->belongsTo(Auction::getClass());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
       return $this->belongsTo(User::getClass());
    }

}