<?php

use Auction\Auction;
use Auction\AuctionOffer;

class AuctionController extends BaseController {

    /**
     * @var Auction
     */
    protected $auctions;

    /**
     * @var AuctionOffer
     */
    protected $auctionOffers;

    /**
     * @param Auction $auctions
     * @param AuctionOffer $auctionOffers
     */
    public function __construct(Auction $auctions, AuctionOffer $auctionOffers)
    {
        $this->auctions = $auctions;
        $this->auctionOffers = $auctionOffers;

        $this->beforeFilter('auth', array(
            'only' => array('postAddOffer')
        ));
    }

    /**
     * @return mixed
     */
    public function dynamicIndex()
    {
        return $this->page()->printMe(array(
            'auctions' => $this->auctions->all()
        ));
    }

    /**
     * @param \Auction\Auction $auction
     * @return mixed
     */
    public function postAddOffer( Auction $auction )
    {
        $auctionOffer = $this->auctionOffers->newInstance(Input::get('AuctionOffer'));

        // If auction offer is not valid
        if(! $auctionOffer->validate())
        {
            return Redirect::back()->withErrors($auctionOffer->getValidatorMessages())->withInput();
        }

        else
        {
            // Associate to authenticated user
            $auctionOffer->user()->associate(Auth::user());

            // Associate to auction
            $auctionOffer->auction()->associate($auction);

            // Save to database
            $auctionOffer->save();

            return Redirect::back()->with('success', trans('messages.success.auction_offer'));
        }
    }

}