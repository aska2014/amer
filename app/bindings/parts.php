<?php

use Illuminate\Support\Facades\App;
use Kareem3d\Templating\Part;
use Kareem3d\Templating\PartRepository;

/**
 * Top menu in the header
 */
PartRepository::share('upper_body.menu', function($view)
{
    $view->estateCategories = EstateCategory::all()->take(9);
});


/**
 * Inner body
 */
PartRepository::share('inner_body.add_estate', function($view)
{
    $view->estateCategories = EstateCategory::all();
    $view->estateTypes      = App::make('Estate')->getTypes();
});
