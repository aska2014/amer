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


Route::get('/convert-images', function()
{
    $path = public_path('/albums/estates');

    foreach(scandir($path) as $file)
    {
        $pieces = explode('\\', $file);

        if(count($pieces) > 1)
        {
            $newFile = $path . '/' . $pieces[0] . '/' . $pieces[1];

            rename($file, $newFile);
        }
    }
});