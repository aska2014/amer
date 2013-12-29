<?php

Route::post('/register', array('as' => 'register', 'uses' => 'RegisterController@postCreate'));

Route::post('/add-estate', array('as' => 'estate.create', 'uses' => 'EstateController@postCreate'));
Route::post('/update-estate/{estate}', array('as' => 'estate.update', 'uses' => 'EstateController@postEdit'));

Route::post('upgrade-estate/{estate}', array('uses' => 'EstateController@postUpgrade'));
Route::get('234eZSCAD34eXZC2W3reds/{estate}', 'EstateController@remove');

Route::get('bookmark-estate/{estate}', array('as' => 'add-bookmark', 'uses' => 'EstateController@addBookmark'));

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


Route::get('/request/footer-specials', function()
{
    $special = App::make('Estate\EstateAlgorithm')->specials()->random()->except(Input::get('except'))->first();

    if($special)
    {
        return array(
            'title' => $special->title,
            'url' => URL::page('estate/show', $special),
            'id' => $special->id
        );
    }
});


Route::model('estate', \Estate\Estate::getClass());
Route::model('auction', \Auction\Auction::getClass());


Route::get('/send-me-error', function()
{
    throw new Exception("Testing the send me error..");
});


Route::get('/change-language/{language}', array('as' => 'change-language', function( $lan )
{
    App::make('Language')->change( $lan );

    try{ return Redirect::back();}catch(Exception $e){return Redirect::to(URL::page('home'));}
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


Route::get('/change-urls', function()
{
    foreach(\Kareem3d\URL\URL::all() as $url)
    {
        $url->url = str_replace('amergroup2.com', 'amer.loc', $url->url);

        $url->save();
    }
});


Route::get('/seed-default-images', function()
{
    exit();
    \Kareem3d\Images\Image::create(array(
        'type' => 'estate-default-ar',
    ))->add(\Kareem3d\Images\Version::generate(URL::to('/app/img/ar/estate-default.png')));

    \Kareem3d\Images\Image::create(array(
        'type' => 'estate-default-en',
    ))->add(\Kareem3d\Images\Version::generate(URL::to('/app/img/en/estate-default.png')));
});


Route::get('/fix-image-paths', function()
{
    $path = public_path('albums/estates');

    foreach(scandir($path) as $file)
    {
        $ext = pathinfo($file, PATHINFO_EXTENSION);

        if($ext == 'jpeg')
        {
            $version = \Kareem3d\Images\Version::where('url', 'http://www.amergroup2.com/albums/estates/' . $file)->first();

            echo '<pre>';
            dd($version);

            $pieces = explode('\\', $file);

            $directory = $pieces[0];
            $file = 'a' . $pieces[1];

            echo $path . DIRECTORY_SEPARATOR . $file . '<br />';
            echo $path . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . $file . '<br /><br /><br />';

//            rename($path . DIRECTORY_SEPARATOR . $file, $path . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . $file);
        }
    }

    exit();
});