<?php

try{
    /**
     * @param $router \Kareem3d\Link\DynamicRouter
     */
    $router = App::make('Kareem3d\Link\Generator')->dynamicRouter();

    // Launch dynamic router
    $router->launch();

}catch(Exception $e){}


// Require bindings files
require app_path('bindings/pages.php');
require app_path('bindings/parts.php');



Route::get('/generate-default-links', function()
{
    App::make('Kareem3d\Link\Generator')->seed();
});


Route::post('/login', array('as' => 'login', 'uses' => 'LoginController@check'));

Route::post('/register', array('as' => 'register', 'uses' => 'RegisterController@store'));

Route::post('/add-estate', array('as' => 'add-estate', 'uses' => 'EstateController@store'));





Route::get('/test', function()
{
});