<?php

use Tracking\Tracker;

class LoginController extends BaseController {

    /**
     * @var User
     */
    protected $users;

    /**
     * @param User $users
     */
    public function __construct(User $users)
    {
        $this->users = $users;

        $this->beforeFilter('guest');
    }

    /**
     * @return mixed
     */
    public function dynamicShow()
    {
        return $this->page()->printMe();
    }

    /**
     * @return mixed
     */
    public function check()
    {
        // Attempt to login with user inputs
        if(Auth::attempt($this->getLoginInputs(), Input::has('Login.remember')))
        {
            // If the previous url is equal to the register-login url
            if(URL::previous() === URL::page('login-register'))
            {
                $redirectUrl = Tracker::instance()->getBefore(URL::previous());
            }

            // Else which means he might have logged in from the home page..
            else
            {
                $redirectUrl = URL::previous();
            }

            return Redirect::to($redirectUrl)->with('success', trans('messages.success.login'));
        }

        return Redirect::to(URL::page('login/show'))->withErrors(trans('messages.errors.login'))->withInput();
    }

    /**
     * @return array
     */
    protected function getLoginInputs()
    {
        return Input::get('Login' , array());
    }

}