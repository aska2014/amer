<?php

try{
    /**
     * @param $router \Kareem3d\Link\DynamicRouter
     */
    $router = App::make('Kareem3d\Link\Generator')->dynamicRouter();

    // Estate controller show method
    $router->attach('add-estate', 'AddEstateController@show');

    // Login Controller
    $router->attach('login-register', 'LoginController@show');

    // Launch dynamic router
    $router->launch();

}catch(Exception $e){}




Route::post('/register', array('as' => 'register', 'uses' => 'RegisterController@store'));

Route::post('/add-estate', array('as' => 'add-estate', 'uses' => 'AddEstateController@store'));

Route::post('/login', array('as' => 'login', 'uses' => 'LoginController@check'));

Route::get('/logout', array('as' => 'logout', function()
{
    Auth::logout();

    try{
        return Redirect::back();
    }catch(Exception $e){
        return Redirect::to(URL::page('home'));
    }
}));






// Require bindings files
require app_path('bindings/pages.php');
require app_path('bindings/parts.php');


Route::get('/generate-default-links', function()
{
    App::make('Kareem3d\Link\Generator')->seed();
});
