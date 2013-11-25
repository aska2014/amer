<?php

use Kareem3d\Images\Image;
use Kareem3d\Images\ImageFacade;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddEstateController extends BaseController {

    /**
     * @var Estate
     */
    protected $estates;

    /**
     * @var EstateCategory
     */
    protected $estateCategories;

    /**
     * @var UserInfo
     */
    protected $usersInfo;

    /**
     * @var Kareem3d\Images\Image
     */
    protected $images;

    /**
     * @param Estate $estates
     * @param EstateCategory $estateCategories
     * @param UserInfo $usersInfo
     * @param Image $images
     */
    public function __construct( Estate $estates, EstateCategory $estateCategories, UserInfo $usersInfo, Image $images)
    {
        $this->estates = $estates;
        $this->estateCategories = $estateCategories;
        $this->usersInfo = $usersInfo;
        $this->images = $images;

        $this->beforeFilter('auth');
    }

    /**
     * @return mixed
     */
    public function show()
    {
        $estateCategories = $this->estateCategories->parentCategories();

        return $this->page()->printMe(compact('estateCategories'));
    }

    /**
     * @return mixed
     */
    public function store()
    {
        // New instance without saving to database yet
        $estate    = $this->newEstate();
        $ownerInfo = $this->newOwnerInfo();

        // Merge current user information with this information
        Auth::user()->getInfo()->merge($ownerInfo);

        // If there were errors then redirect back with these errors
        if(! $this->emptyErrors())
        {
            return Redirect::back()->withErrors($this->errors)->withInput();
        }

        // No errors where found.. then save the owner info and attach it to the estate
        $ownerInfo->save();

        $estate->ownerInfo()->associate($ownerInfo);

        $estate->save();

        // Save the estate image
        if(! $this->saveEstateImage($estate, Input::file('estate-img', null)))
        {
            // Roll back all creations
            $estate->delete();
            $ownerInfo->delete();

            return Redirect::back()->withErrors(trans('messages.errors.image'))->withInput();
        }

        return Redirect::to(URL::page('one-estate', $estate))->with('success', trans('messages.success.estate'));
    }

    /**
     * @param Estate $estate
     * @param UploadedFile $file
     * @return bool
     */
    protected function saveEstateImage(Estate $estate, UploadedFile $file = null)
    {
        if($file == null) return false;

        $versions = ImageFacade::versions('Estate.Main', 'estate-', $file, false);

        $image = $this->images->create(array(
            'title' => $estate->title,
            'alt'   => $estate->description,
        ))->add($versions);

        return $estate->replaceImage($image, 'main');
    }

    /**
     * @return Estate
     */
    protected function newEstate()
    {
        $estateInputs = $this->getEstateInputs();

        $estate = $this->estates->newInstance($estateInputs);

        if(! $estate->validate()) {

            $this->addErrors($estate->getValidatorMessages());
        }

        return $estate;
    }

    /**
     * @return UserInfo
     */
    protected function newOwnerInfo()
    {
        $userInfoInputs = $this->getUserInfoInputs();

        $userInfo = $this->usersInfo->newInstance($userInfoInputs);

        if(! $userInfo->validate()) {

            $this->addErrors($userInfo->getValidatorMessages());
        }

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

}