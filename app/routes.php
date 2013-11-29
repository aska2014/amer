<?php

Route::post('/register', array('as' => 'register', 'uses' => 'RegisterController@store'));

Route::post('/add-estate', array('as' => 'estate.create', 'uses' => 'EstateController@postCreate'));
Route::post('/update-estate/{estate}', array('as' => 'estate.update', 'uses' => 'EstateController@postEdit'));

Route::post('upgrade-estate/{estate}', array('uses' => 'EstateController@postUpgrade'));

Route::post('/login', array('as' => 'login', 'uses' => 'LoginController@check'));

Route::post('/add-auction-offer-{auction}', array('as' => 'add-auction', 'uses' => 'AuctionController@addOffer'));

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
        var_dump(DB::table('ka_user_accounts')
            ->join('ka_user_info', 'ka_user_accounts.user_info_id', '=', 'ka_user_info.id')
            ->where('email', $estate->ownerInfo->contact_email)->select(array('ka_user_accounts.id')) . PHP_EOL);
    }
});