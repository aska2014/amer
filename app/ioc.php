<?php

use Illuminate\Support\MessageBag;

/**
 * Share success message if isset in the session
 */
View::share('success', new MessageBag((array) Session::get('success', array())));

View::share('authUser', Auth::user());

App::bind('Kareem3d\Membership\User', function()
{
    return new User;
});