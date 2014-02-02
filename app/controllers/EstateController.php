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

    const ESTATES_PER_PAGE = 10;

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
     * @var UserAlgorithm
     */
    protected $usersAlgorithm;

    /**
     * @var Comment
     */
    protected $comments;

    /**
     * @var Bookmark
     */
    protected $bookmarks;

    /**
     * @var EstatePermission
     */
    protected $permissions;

    /**
     * @param Estate $estates
     * @param EstateCategory $estateCategories
     * @param Auction $auctions
     * @param UserInfo $usersInfo
     * @param Image $images
     * @param SpecialPayment $specialPayments
     * @param SpecialOffer $specialOffers
     * @param EstateAlgorithm $estatesAlgorithm
     * @param UserAlgorithm $usersAlgorithm
     * @param Comment $comments
     * @param Bookmark $bookmarks
     * @param EstatePermission $permissions
     */
    public function __construct( Estate $estates, EstateCategory $estateCategories, Auction $auctions,
                                 UserInfo $usersInfo, Image $images, SpecialPayment $specialPayments, SpecialOffer $specialOffers,
                                 EstateAlgorithm $estatesAlgorithm, UserAlgorithm $usersAlgorithm,
                                 Comment $comments, Bookmark $bookmarks, EstatePermission $permissions)
    {
        $this->estates = $estates;
        $this->estateCategories = $estateCategories;
        $this->estatesAlgorithm = $estatesAlgorithm;
        $this->auctions = $auctions;
        $this->usersInfo = $usersInfo;
        $this->images = $images;
        $this->specialPayments = $specialPayments;
        $this->specialOffers = $specialOffers;
        $this->usersAlgorithm = $usersAlgorithm;
        $this->comments = $comments;
        $this->bookmarks = $bookmarks;
        $this->permissions = $permissions;

        $this->beforeFilter('auth', array(
            'except' => array('amerGroupSpecials', 'specialOffers' ,'all', 'show')
        ));
    }

    /**
     * @return mixed
     */
    public function dynamicSpecialOffers()
    {
        $estatesTitle = trans('titles.special_offers');

        $estates = $this->estatesAlgorithm->language()->specials()->paginate(self::ESTATES_PER_PAGE);

        return $this->page()->printMe(compact('estates', 'estatesTitle'));
    }

    /**
     * @return mixed
     */
    public function dynamicAmerGroupSpecials()
    {
        $estatesTitle = trans('titles.amer_specials');

        // Get amer group user
        $amerGroupUser = $this->usersAlgorithm->byEmail('info@amergroup2.com')->first(array('id'));

        if(! $amerGroupUser) return Redirect::to(URL::page('home'));

        $estates = $this->estatesAlgorithm->byUser($amerGroupUser)->language()->paginate(self::ESTATES_PER_PAGE);

        return $this->page()->printMe(compact('estates', 'estatesTitle'));
    }

    /**
     * @param \Estate\EstateCategory $category
     * @return mixed
     */
    public function dynamicAll(EstateCategory $category)
    {
        $estatesTitle = $category->getDescriptiveTitle();

        $estates = $this->estatesAlgorithm->language()->orderByDate()->underCategory($category)->accepted()->paginate(self::ESTATES_PER_PAGE);

        return $this->page()->printMe(compact('estates', 'estatesTitle'));
    }

    /**
     *
     * @param \Estate\Estate $estate
     * @throws Kareem3d\Membership\NoAccessException
     * @return mixed
     */
    public function dynamicShow(Estate $estate)
    {
        // If this user can not display this estate
        if(! $this->permissions->canDisplay($estate))
        {
            // Change this to be more general than a not accepted
            throw new \Kareem3d\Membership\NoAccessException("You don't have access to see this estate.");
        }

        // Increment number of views
        $estate->incrementViews();

        // If it's auction and this user can add auction offer
        $showAddAuctionOffer = $estate->auction && $this->permissions->canAddAuctionOffer($estate);

        // Show not accepted message if estate is not accepted
        $showNotAcceptedMessage = !$estate->accepted;

        // If it's not an auction and the user can add comment
        $showAddComment = ! $estate->auction && $this->permissions->canAddComment($estate);

        return $this->page()->printMe(compact('estate', 'showAddAuctionOffer', 'showNotAcceptedMessage', 'showAddComment'));
    }

    /**
     * @param \Estate\Estate $estate
     * @throws Kareem3d\Membership\NoAccessException
     * @return mixed
     */
    public function dynamicEdit($estate)
    {
        if(! $this->permissions->canEdit($estate))
        {
            throw new \Kareem3d\Membership\NoAccessException("You don't have permission to edit this estate.");
        }

        $estateCategories = $this->estateCategories->parentCategories();

        $eFiller = new Filler($estate, Input::old('Estate'));
        $aFiller = new Filler($estate->auction, Input::old('Auction'));
        $uFiller = new Filler($estate->ownerInfo, Input::old('UserInfo'));

        return $this->page()->printMe(compact('estateCategories', 'estate', 'eFiller', 'aFiller', 'uFiller'));
    }

    /**
     * @param Estate $estate
     * @throws Kareem3d\Membership\NoAccessException
     * @return mixed
     */
    public function postEdit(Estate $estate)
    {
        if($estate->exists && ! $this->permissions->canEdit($estate))
        {
            throw new \Kareem3d\Membership\NoAccessException("You don't have permission to edit this estate.");
        }

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
            $estate->hasAuction() ? $estate->auction()->update($auctionInputs) : $estate->auction()->create($auctionInputs);

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
     * @throws Kareem3d\Membership\NoAccessException
     * @return mixed
     */
    public function dynamicCreate()
    {
        if(! $this->permissions->canCreate())
        {
            throw new \Kareem3d\Membership\NoAccessException("You don't have permissions to create estate");
        }

        $estate = $this->estates->newInstance();

        $estateCategories = $this->estateCategories->parentCategories();

        $eFiller = Filler::fromInput(Input::old('Estate'));
        $aFiller = Filler::fromInput(Input::old('Auction'));
        $uFiller = new Filler( Auth::user()->userInfo ,Input::old('UserInfo'));

        return $this->page()->printMe(compact('estateCategories', 'estate', 'eFiller', 'aFiller', 'uFiller'));
    }

    /**
     * @throws Kareem3d\Membership\NoAccessException
     * @return mixed
     */
    public function postCreate()
    {
        if(! $this->permissions->canCreate())
        {
            throw new \Kareem3d\Membership\NoAccessException("You don't have permissions to create estate");
        }

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
     * @throws Kareem3d\Membership\NoAccessException
     * @return mixed
     */
    public function dynamicUpgrade( Estate $estate )
    {
        if(! $this->permissions->canUpgrade($estate))
        {
            throw new \Kareem3d\Membership\NoAccessException("You don't have permissions to upgrade this estate");
        }

        $offers = $this->specialOffers->all();

        return $this->page()->printMe(compact('estate', 'offers'));
    }

    /**
     * @param \Estate\Estate $estate
     * @throws Kareem3d\Membership\NoAccessException
     * @return mixed
     */
    public function postUpgrade( Estate $estate )
    {
        if(! $this->permissions->canUpgrade($estate))
        {
            throw new \Kareem3d\Membership\NoAccessException("You don't have permissions to upgrade this estate");
        }

        $estate->specialPayments()->delete();

        $specialPayment = $this->specialPayments->newInstance(Input::get('SpecialPayment'));

        $specialPayment->user()->associate(Auth::user());

        $specialPayment->estate()->associate($estate);

        $specialPayment->save();

        return Redirect::to(URL::page('estate/show', $estate))->with('success', trans('messages.success.upgrade'));
    }

    /**
     * @param Estate $estate
     * @throws Kareem3d\Membership\NoAccessException
     * @return
     */
    public function remove(Estate $estate)
    {
        if(! $this->permissions->canDelete($estate))
        {
            throw new \Kareem3d\Membership\NoAccessException("You don't have permissions to delete this estate");
        }

        $estate->delete();

        return Redirect::to(URL::page('user/estates'))->with('success', trans('messages.success.estate.delete'));
    }

    /**
     * @param Estate $estate
     * @throws Kareem3d\Membership\NoAccessException
     * @return
     */
    public function postAddComment(Estate $estate)
    {
        if(! $this->permissions->canAddComment($estate))
        {
            throw new \Kareem3d\Membership\NoAccessException("You don't have permissions to add this comment");
        }

        $comment = $this->comments->newInstance(Input::get('Comment'));

        $comment->user()->associate(Auth::user());

        $comment->attachTo($estate);

        if($comment->validate())
        {
            $comment->save();


            // Send notification email to the user who owns the estate
            $notification = array(
                'title' => 'من موقع عامر جروب2',
                'description' => 'قام أحد الأعضاء بالتعليق على عقار خاص بك.<br /><br />لمشاهدة التعليق<a href="'.URL::page('estate/show', $estate).'">                من هنا</a>');

            $user = $estate->user;

            Mail::send('emails.notification', compact('notification'), function($message) use($user)
            {
                $message->to($user->email, $user->name)->subject('شكراً لتسجيلك فى موقع عامر جروب2');
            });

            return Redirect::back()->with('success', trans('messages.success.comment'));
        }

        return Redirect::back()->withErrors($comment->getValidatorMessages())->withInput();
    }

    /**
     * @param Estate $estate
     * @return mixed
     */
    public function addBookmark(Estate $estate)
    {
        $this->bookmarks->add(Auth::user(), $estate);

        return Redirect::back()->with('success', trans('messages.success.bookmark'));
    }

    /**
     * @param Estate $estate
     */
    public function postBlock(Estate $estate)
    {
    }

    /**
     * @param Estate $estate
     * @param UserInfo $ownerInfo
     * @param Auction $auction
     */
    protected function validate(Estate $estate, UserInfo $ownerInfo, Auction $auction = null)
    {
        $estate->validate() && $this->addErrors($estate->getValidatorMessages());
        $estate->validate() && $this->addErrors($ownerInfo->getValidatorMessages());
        $auction && $auction->validate() && $this->addErrors($auction->getValidatorMessages());
    }

    /**
     * @param Estate $estate
     * @param UserInfo $ownerInfo
     * @param UploadedFile $file
     * @param array $files
     * @param Auction $auction
     * @return bool
     */
    protected function save( Estate $estate, UserInfo $ownerInfo, UploadedFile $file = null, $files = array(), Auction $auction = null )
    {
        ///////////////////////////////////////////////////////////////////////////////////
        // Creation process
        ///////////////////////////////////////////////////////////////////////////////////

        // 1. Save owner info
        $ownerInfo->save();

        // 2. Associate estate with the owner info (this might be not equal to the user information)
        $estate->ownerInfo()->associate($ownerInfo);

        // 3. Associate estate with the authenticated user
        $estate->user()->associate(Auth::user());

        // 4. Now save estate
        $estate->save();

        // 5. If auction is defined for this estate then save it else then delete any associated auction
        ($auction ? $estate->auction()->save($auction) : $estate->auction()->delete());

        // 6. Merge authenticated user with the given owner information
        Auth::user()->getInfo()->merge($ownerInfo);

        // 7. Save estate image
        $imageSaved = (bool) $this->saveEstateImage($estate, $file);

        // 8. Save all estate images (gallery images)
        $imagesSaved = $this->saveEstateGalleryImages($estate, $files) > 0;

        // Accept state if image not saved
        if(! $imageSaved && ! $imagesSaved) $estate->accept();

        ///////////////////////////////////////////////////////////////////////////////////
        // END creation process
        ///////////////////////////////////////////////////////////////////////////////////
    }

    /**
     * @param Estate $estate
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @return bool
     */
    protected function saveEstateImage(Estate $estate, \Symfony\Component\HttpFoundation\File\UploadedFile $file = null)
    {
        if($file == null) return false;

        $versions = ImageFacade::versions('Estate.Main', 'estate', $file, false);

        if($versions)
        {
            $image = $this->images->create(array(
                'title' => $estate->title,
                'alt'   => $estate->description,
            ))->add($versions);

            return $estate->replaceImage($image, 'main');
        }
    }

    /**
     * @param Estate $estate
     * @param array $files
     * @return int
     */
    protected function saveEstateGalleryImages(Estate $estate, array $files = array())
    {
        $numberSaved = 0;

        foreach($files as $file)
        {
            if($file == null) continue;

            $versions = ImageFacade::versions('Estate.Gallery', 'estate', $file, false);

            if($versions)
            {
                $image = $this->images->create(array(
                    'title' => $estate->title,
                    'alt'   => $estate->description,
                ))->add($versions);

                $estate->addImage($image, 'gallery');

                $numberSaved ++;
            }
        }

        return $numberSaved;
    }

    /**
     * @param Estate $estate
     * @param UserInfo $ownerInfo
     * @param Auction $auction
     * @return boolean
     */
    protected function validateAndSave(Estate $estate, UserInfo $ownerInfo, Auction $auction = null)
    {
        $this->validate($estate, $ownerInfo, $auction);

        // If errors are not empty then return false
        if(! $this->emptyErrors()) return false;

        $this->save($estate, $ownerInfo, Input::file('estate-img', null), Input::file('gallery-imgs', array()), $auction);

        return true;
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
        return Input::get('estate-has-auction') == 'true' ? Input::get('Auction') : array();
    }

}