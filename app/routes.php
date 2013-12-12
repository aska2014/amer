<?php

Route::post('/register', array('as' => 'register', 'uses' => 'RegisterController@postCreate'));

Route::post('/add-estate', array('as' => 'estate.create', 'uses' => 'EstateController@postCreate'));
Route::post('/update-estate/{estate}', array('as' => 'estate.update', 'uses' => 'EstateController@postEdit'));

Route::post('upgrade-estate/{estate}', array('uses' => 'EstateController@postUpgrade'));
Route::get('234eZSCAD34eXZC2W3reds/{estate}', 'EstateController@remove');


Route::post('/login', array('as' => 'login', 'uses' => 'LoginController@check'));

Route::post('/add-auction-offer-{auction}', array('as' => 'add-auction', 'uses' => 'AuctionController@postAddOffer'));

Route::post('/add-comment-{estate}', array('as' => 'add-comment', 'uses' => 'EstateController@postAddComment'));

Route::post('/contact-us.html', array('as' => 'contact-us', 'uses' => 'ContactUsController@postCreate'));

Route::post('/request-banner.html', array('as' => 'banner-request', 'uses' => 'BannerController@postRequest'));


Route::get('/logout', array('as' => 'logout', function()
{
    Auth::logout();

    try{ return Redirect::back();}catch(Exception $e){return Redirect::to(URL::page('home'));}
}));


Route::model('estate', \Estate\Estate::getClass());
Route::model('auction', \Auction\Auction::getClass());


Route::get('/send-me-error', function()
{
    throw new Exception("Testing the send me error..");
});


Route::get('/change-language/{language}', array('as' => 'change-language', function( $lan )
{
    App::make('Language')->change( $lan );

    return Redirect::back();
}));


Route::get('/seed-banner-places', function()
{
    exit();
   \Website\BannerPlace::query()->delete();

    \Website\BannerPlace::create(array(
        'width' => 303,
        'height' => 252,
        'name' => 'sidebar',
    ));

    \Website\BannerPlace::create(array(
        'width' => 618,
        'height' => 93,
        'name' => 'upper_body',
    ));
});
