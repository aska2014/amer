<?php

class EstateController extends BaseController {

    /**
     * @var Estate
     */
    protected $estates;

    /**
     * @var UserInfo
     */
    protected $usersInfo;

    /**
     * @param Estate $estates
     * @param UserInfo $usersInfo
     */
    public function __construct( Estate $estates, UserInfo $usersInfo )
    {
        $this->estates = $estates;
        $this->usersInfo = $usersInfo;
    }

    /**
     * @return mixed
     */
    public function store()
    {
        $estate    = $this->newEstate();
        $ownerInfo = $this->newOwnerInfo();

        if(! $this->emptyErrors())
        {
            return Redirect::back()->withErrors($this->errors);
        }

        else
        {
            $ownerInfo->save();

            $estate->ownerInfo()->associate($ownerInfo);

            $estate->save();

            return Redirect::back()->with('success', 'تم إضافة العقار بنجاح.');
        }
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