<?php

use Illuminate\Support\MessageBag;

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
    }

    /**
     * @return mixed
     */
    public function check()
    {
        // Attempt to login with user inputs
        if(Auth::attempt($this->getLoginInputs(), Input::has('Login.remember')))
        {
            return Redirect::back()->with('success', 'لقد تم الدخول بنجاح.');
        }

        $this->addErrors(array('الإيميل او الباسورد غير صحيح.'));

        return Redirect::back()->withErrors($this->errors);
    }

    /**
     * @return array
     */
    protected function getLoginInputs()
    {
        return Input::get('Login');
    }

}