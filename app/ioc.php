<?php

use Illuminate\Support\MessageBag;

/**
 * Share success message if isset in the session
 */
View::share('success', new MessageBag((array) Session::get('success', array())));

//View::share('errors', new MessageBag((array) Session::get('errors', array())));

View::share('authUser', Auth::user());

App::bind('Kareem3d\Membership\User', function()
{
    return new User;
});

App::bind('Kareem3d\Membership\UserInfo', function()
{
    return new UserInfo;
});

App::singleton('DateTime\DateTimeInterface', function()
{
    return App::make('Language')->is('en') ? new \DateTime\EnglishDateTime() : new \DateTime\ArabicDateTime();
});


View::share('date', App::make('DateTime\DateTimeInterface'));
