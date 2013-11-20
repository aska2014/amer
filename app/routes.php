<?php

/**
 * @param $router \Kareem3d\Link\DynamicRouter
 */
$router = App::make('Kareem3d\Link\Generator')->dynamicRouter();

// Launch dynamic router
try{ $router->launch(); }catch(Exception $e){}





Route::get('/generate-default-links', function()
{
    App::make('Kareem3d\Link\Generator')->seed();
});