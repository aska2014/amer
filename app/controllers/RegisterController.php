<?php

use Helper\Helper;

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

        $this->beforeFilter('guest');
    }

    /**
     * User clicks forgets password
     */
    public function dynamicForgetPassword()
    {
        return $this->page()->printMe();
    }

    /**
     * User enters his email and click to retrieve password
     */
    public function postRetrievePassword()
    {
        $email = Input::get('Retrieve.email');

        // User exists then send him the retrieve password email
        if(! $user = $this->users->getByEmail($email))
        {
            return Redirect::back()->with('errors', trans('messages.errors.email_not_exists'));
        }

        // Url to retrieve password
        $url = URL::page('register/change-password') . '?user_token=' . $user->getToken();


        // Send mail to the user to retrieve password
        Mail::send('emails.auth.retrieve', compact('user', 'url'), function($message) use($user)
        {
            $message->to($user->email, $user->name)->subject('AmerGroup2 forgot password');
        });

        return Redirect::back()->with('success', trans('messages.success.retrieve_password_mail_sent'));
    }

    /**
     * @throws Kareem3d\Membership\NoAccessException
     * @internal param $token
     * @return mixed
     */
    public function dynamicChangePassword()
    {
        $userToken = Input::get('user_token');

        if(! $user = $this->users->getByToken($userToken)) throw new \Kareem3d\Membership\NoAccessException();

        return $this->page()->printMe(compact('userToken'));
    }

    /**
     * @param $token
     * @throws Kareem3d\Membership\NoAccessException
     * @return mixed
     */
    public function postChangePassword($token)
    {
        $newPassword = Input::get('Retrieve.new_password');
        $newPasswordAgain = Input::get('Retrieve.new_password_again');

        if($newPassword !== $newPasswordAgain)
        {
            return Redirect::back()->with('errors', trans('messages.errors.password_not_match'));
        }

        if(! $user = $this->users->getByToken($token)) throw new \Kareem3d\Membership\NoAccessException();

        if($user->changePassword($newPassword))
        {
            return Redirect::to(URL::page('login/show'))->with('success', trans('messages.success.password_changed'));
        }
    }

    /**
     * @return mixed
     */
    public function postCreate()
    {
        $user     = $this->newUser();
        $userInfo = $this->newUserInfo();

        // If errors are not empty then redirect with errors
        if(! $this->emptyErrors())
        {
            return Redirect::back()->withErrors($this->errors->toArray());
        }

        $user->setInfo($userInfo);

        Auth::login($user, false);

        return Redirect::to(URL::page('home'))->with('success', trans('messages.success.register'))->withInput();
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
        return Helper::instance()->arrayGetKeys(Input::get('Register'), array('email', 'password'));
    }

    /**
     * Get rest of keys which are supposed to be the user info as far as we know
     *
     * @return mixed
     */
    protected function getUserInfoInputs()
    {
        $userInfoInputs = array_diff_key(Input::get('Register'), $this->getUserInputs());

        // Contact email is the same email he registered with.
        $userInfoInputs['contact_email'] = Input::get('Register.email');

        return $userInfoInputs;
    }
}