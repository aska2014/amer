<?php

Route::post('/register', array('as' => 'register', 'uses' => 'RegisterController@store'));

Route::post('/add-estate', array('as' => 'estate.create', 'uses' => 'EstateController@postCreate'));
Route::post('/update-estate/{estate}', array('as' => 'estate.update', 'uses' => 'EstateController@postEdit'));

Route::post('upgrade-estate/{estate}', array('uses' => 'EstateController@postUpgrade'));
Route::get('234eZSCAD34eXZC2W3reds/{estate}', 'EstateController@remove');


Route::post('/login', array('as' => 'login', 'uses' => 'LoginController@check'));

Route::post('/add-auction-offer-{auction}', array('as' => 'add-auction', 'uses' => 'AuctionController@addOffer'));

Route::post('/contact-us.html', array('as' => 'contact-us', 'uses' => 'ContactUsController@send'));


Route::get('/logout', array('as' => 'logout', function()
{
    Auth::logout();

    try{ return Redirect::back();}catch(Exception $e){return Redirect::to(URL::page('home'));}
}));


Route::model('estate', \Estate\Estate::getClass());
Route::model('auction', \Auction\Auction::getClass());


Route::get('/test', function()
{
    foreach(\Estate\Estate::all() as $estate)
    {
        $estate->province_id = 6;
        $estate->save();
    }
});