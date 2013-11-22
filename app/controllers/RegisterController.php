<?php

use Kareem3d\Membership\UserInfo;

class RegisterController extends BaseController {

    /**
     * @var User
     */
    protected $users;

    /**
     * @var Kareem3d\Membership\UserInfo
     */
    protected $usersInfo;

    /**
     * @param User $users
     * @param UserInfo $usersInfo
     */
    public function __construct( User $users, UserInfo $usersInfo)
    {
        $this->users = $users;
        $this->usersInfo = $usersInfo;
    }

    /**
     * @return mixed
     */
    public function store()
    {
        $user     = $this->newUser();
        $userInfo = $this->newUserInfo();

        // If errors are not empty then redirect with errors
        if(! $this->emptyErrors())
        {
            return Redirect::back()->withErrors($this->errors->toArray());
        }

        $user->setInfo($userInfo);

        return Redirect::to(URL::page('home'))->with('success', 'لقد تم التسجيل بنجاح');
    }

    /**
     * @return User
     */
    protected function newUser()
    {
        $userInputs = $this->getUserInputs();

        $user = $this->users->newInstance($userInputs);

        // If user is valid
        if(! $user->validate()) {

            $this->addErrors($user->getValidatorMessages());
        }

        return $user;
    }

    /**
     * @return UserInfo
     */
    protected function newUserInfo()
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
    protected function getUserInputs()
    {
        return Input::get('User');
    }

    /**
     * @return mixed
     */
    protected function getUserInfoInputs()
    {
        return Input::get('UserInfo');
    }
}