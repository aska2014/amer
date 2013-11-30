<?php

use Auction\Auction;
use Estate\Estate;
use Estate\EstateAlgorithm;
use Estate\EstateCategory;
use Helper\EmptyClass;
use Kareem3d\Eloquent\Extensions\Acceptable\NotAcceptedException;
use Kareem3d\Images\Image;
use Kareem3d\Images\ImageFacade;
use Special\SpecialOffer;
use Special\SpecialPayment;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class EstateController extends BaseController {

    /**
     * @var Estate
     */
    protected $estates;

    /**
     * @var EstateCategory
     */
    protected $estateCategories;

    /**
     * @var Auction
     */
    protected $auctions;

    /**
     * @var UserInfo
     */
    protected $usersInfo;

    /**
     * @var Kareem3d\Images\Image
     */
    protected $images;

    /**
     * @var SpecialPayment
     */
    protected $specialPayments;

    /**
     * @var SpecialOffer
     */
    protected $specialOffers;

    /**
     * @var \Estate\EstateAlgorithm
     */
    protected $estatesAlgorithm;

    /**
     * @param Estate $estates
     * @param EstateCategory $estateCategories
     * @param Auction $auctions
     * @param UserInfo $usersInfo
     * @param Image $images
     * @param SpecialPayment $specialPayments
     * @param SpecialOffer $specialOffers
     * @param EstateAlgorithm $estatesAlgorithm
     */
    public function __construct( Estate $estates, EstateCategory $estateCategories, Auction $auctions,
                                 UserInfo $usersInfo, Image $images, SpecialPayment $specialPayments, SpecialOffer $specialOffers,
                                 EstateAlgorithm $estatesAlgorithm)
    {
        $this->estates = $estates;
        $this->estateCategories = $estateCategories;
        $this->estatesAlgorithm = $estatesAlgorithm;
        $this->auctions = $auctions;
        $this->usersInfo = $usersInfo;
        $this->images = $images;
        $this->specialPayments = $specialPayments;
        $this->specialOffers = $specialOffers;
    }

    /**
     * @param \Estate\EstateCategory $category
     * @return mixed
     */
    public function all(EstateCategory $category)
    {
        $estatesTitle = $category->parent ? "{$category->parent->title} > {$category->title}" : $category->title;

        $estates = $this->estatesAlgorithm->underCategory($category)->accepted()->get();

        return $this->page()->printMe(compact('estates', 'estatesTitle'));
    }

    /**
     *
     * @param \Estate\Estate $estate
     * @throws Kareem3d\Eloquent\Extensions\Acceptable\NotAcceptedException
     * @return mixed
     */
    public function show(Estate $estate)
    {
        $isOwnerUser = Auth::user() AND Auth::user()->same($estate->user);

        // If it's not accepted and the authenticated user not the owner then throw not accepted exception
        if(! $estate->accepted AND ! $isOwnerUser)
        {
            throw new NotAcceptedException;
        }

        // If it's auction and not the owner user
        $showAddAuctionOffer = $estate->auction AND ! $isOwnerUser;

        // Show not accepted message if estate is not accepted and is the owner user
        $showNotAcceptedMessage = !$estate->accepted AND $isOwnerUser;

        return $this->page()->printMe(compact('estate', 'showAddAuctionOffer', 'showNotAcceptedMessage'));
    }

    /**
     * @param \Estate\Estate $estate
     * @throws Exception
     * @return mixed
     */
    public function edit($estate)
    {
        $this->beforeFilter('auth');

        if($estate->exists AND ! Auth::user()->same($estate->user))
        {
            throw new Exception("You can't edit this estate");
        }

        $estateCategories = $this->estateCategories->parentCategories();

        $eFiller = new Filler($estate, Input::old('Estate'));
        $aFiller = new Filler($estate->auction, Input::old('Auction'));
        $uFiller = new Filler($estate->ownerInfo, Input::old('UserInfo'));

        return $this->page()->printMe(compact('estateCategories', 'estate', 'eFiller', 'aFiller', 'uFiller'));
    }

    /**
     * @param Estate $estate
     * @return mixed
     */
    public function postEdit(Estate $estate)
    {
        $this->beforeFilter('auth');

        $estate->fill($this->getEstateInputs());
        $estate->ownerInfo->fill($this->getUserInfoInputs());

        $auctionInputs = $this->getAuctionInputs();

        // Deleteing auction will delete any auction offers associated with it
        if(empty($auctionInputs))
        {
            $estate->auction()->delete();
        }
        else
        {
            $estate->hasAuction() ? $this->auction()->update($auctionInputs) : $estate->auction()->create($auctionInputs);

            $estate->escapeRule('price');
        }

        // Save to database
        if(! $this->validateAndSave($estate, $estate->ownerInfo, $estate->auction))
        {
            return Redirect::back()->withErrors($this->errors)->withInput();
        }

        // Success redirect to upgrade page with success..
        return Redirect::back()->with('success', trans('messages.success.estate.update'));
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $this->beforeFilter('auth');

        return $this->edit($this->estates->newInstance());
    }

    /**
     * @return mixed
     */
    public function postCreate()
    {
        $this->beforeFilter('auth');

        // New instance without saving to database yet
        $auction   = $this->newAuction();
        $estate    = $this->newEstate( $auction != null );
        $ownerInfo = $this->newOwnerInfo();

        // Save to database
        if(! $this->validateAndSave($estate, $ownerInfo, $auction))
        {
            return Redirect::back()->withErrors($this->errors)->withInput();
        }

        // Success redirect to upgrade page with success..
        return Redirect::to(URL::page('estate/upgrade', $estate))->with('success', trans('messages.success.estate.create'));
    }

    /**
     * @param \Estate\Estate $estate
     * @return mixed
     */
    public function upgrade( Estate $estate )
    {
        $this->beforeFilter('auth');

        $this->throwIfNotOwner($estate);

        $offers = $this->specialOffers->all();

        return $this->page()->printMe(compact('estate', 'offers'));
    }

    /**
     * @param \Estate\Estate $estate
     * @return mixed
     */
    public function postUpgrade( Estate $estate )
    {
        $this->beforeFilter('auth');

        $this->throwIfNotOwner($estate);

        $specialPayment = $this->specialPayments->newInstance(Input::get('SpecialPayment'));

        $specialPayment->user()->associate(Auth::user());

        $specialPayment->estate()->associate($estate);

        $specialPayment->save();

        return Redirect::to(URL::page('estate/show', $estate))->with('success', trans('messages.success.upgrade'));
    }

    /**
     * @param Estate $estate
     * @throws Exception
     */
    public function remove(Estate $estate)
    {
        $this->beforeFilter('auth');

        $this->throwIfNotOwner($estate);

        $estate->delete();

        return Redirect::to(URL::page('user/estates'))->with('success', trans('messages.success.estate.delete'));
    }


    /**
     * @param Estate $estate
     * @param UserInfo $ownerInfo
     * @param Auction $auction
     */
    protected function validate(Estate $estate, UserInfo $ownerInfo, Auction $auction = null)
    {
        $estate->validate() AND $this->addErrors($estate->getValidatorMessages());
        $estate->validate() AND $this->addErrors($ownerInfo->getValidatorMessages());
        $auction AND $auction->validate() AND $this->addErrors($auction->getValidatorMessages());
    }

    /**
     * @param Estate $estate
     * @param UserInfo $ownerInfo
     * @param UploadedFile $file
     * @param Auction $auction
     * @return bool
     */
    protected function save( Estate $estate, UserInfo $ownerInfo, UploadedFile $file = null, Auction $auction = null )
    {
        ///////////////////////////////////////////////////////////////////////////////////
        // Creation process
        ///////////////////////////////////////////////////////////////////////////////////
        $operationStatus =

        // 1. Save owner info
        $ownerInfo->save()

        AND
        // 2. Associate estate with the owner info (this might be not equal to the user information)
        $estate->ownerInfo()->associate($ownerInfo)

        AND
        // 3. Associate estate with the authenticated user
        $estate->user()->associate(Auth::user())

        AND
        // 4. Now save estate
        $estate->save()

        AND
        // 5. If auction is defined for this estate then save it else then delete any associated auction
        ($auction ? $estate->auction()->save($auction) : $estate->auction()->delete())

        AND
        Auth::user()->getInfo()->merge($ownerInfo);

        // If operation is success then try to save estate image
        if($operationStatus)
        {
            $this->saveEstateImage($estate, $file);
        }

        ///////////////////////////////////////////////////////////////////////////////////
        // END creation process
        ///////////////////////////////////////////////////////////////////////////////////


        // If creation process hasn't succeed then roll back all creations
        if($operationStatus !== true)
        {
            // Roll back all creations (estate, ownerInfo and auction)
            $estate->delete();
            $ownerInfo->delete();
            $auction AND $auction->delete();

            return false;
        }

        return true;
    }

    /**
     * @param Estate $estate
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @return bool
     */
    protected function saveEstateImage(Estate $estate, \Symfony\Component\HttpFoundation\File\UploadedFile $file = null)
    {
        if(! $file) return false;

        $versions = ImageFacade::versions('Estate.Main', 'estate', $file, false);

        $image = $this->images->create(array(
            'title' => $estate->title,
            'alt'   => $estate->description,
        ))->add($versions);

        return $estate->replaceImage($image, 'main');
    }

    /**
     * @param Estate $estate
     * @param UserInfo $ownerInfo
     * @param Auction $auction
     * @return mixed
     */
    protected function validateAndSave(Estate $estate, UserInfo $ownerInfo, Auction $auction = null)
    {
        $this->validate($estate, $ownerInfo, $auction);

        // return empty errors and the return of the save mehtod
        return $this->emptyErrors() AND $this->save($estate, $ownerInfo, Input::file('estate-img', null));
    }

    /**
     * @param Estate $estate
     * @throws Exception
     */
    protected function throwIfNotOwner(Estate $estate)
    {
        if(! Auth::user()->same($estate->user))
        {
            throw new Exception("You can't access this page");
        }
    }

    /**
     * @return Auction|null
     */
    protected function newAuction()
    {
        $auctionInputs = $this->getAuctionInputs();

        if(! empty($auctionInputs))
        {
            $auction = $this->auctions->newInstance($auctionInputs);

            return $auction;
        }
    }

    /**
     * @param bool $hasAuction
     * @return Estate
     */
    protected function newEstate( $hasAuction )
    {
        $estateInputs = $this->getEstateInputs();

        $estate = $this->estates->newInstance($estateInputs);

        // If this estate has auction on it then escape the price required rule
        if($hasAuction) $estate->escapeRule('price');

        return $estate;
    }

    /**
     * @return UserInfo
     */
    protected function newOwnerInfo()
    {
        $userInfoInputs = $this->getUserInfoInputs();

        $userInfo = $this->usersInfo->newInstance($userInfoInputs);

        return $userInfo;
    }

    /**
     * @return mixed
     */
    protected function getEstateInputs()
    {
        return Input::get('Estate');
    }

    /**
     * @return mixed
     */
    protected function getUserInfoInputs()
    {
        return Input::get('UserInfo');
    }

    /**
     * @return array
     */
    protected function getAuctionInputs()
    {
        return Input::has('estate-has-auction') ? Input::get('Auction') : array();
    }

}