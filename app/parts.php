<?php

use Illuminate\Support\Facades\App;
use Kareem3d\Templating\Part;
use Kareem3d\Templating\PartRepository;

/**
 * Shared across all parts
 */
PartRepository::shareToAll(function($view)
{
    // Get the get inputs with the page
    $array = $_GET; unset($array['page']);

    $view->getArrayWithoutPage = $array;

    $view->estateCategories = App::make('Estate\EstateCategory')->parentCategories();

    $view->provinces = App::make('Place\Province')->all();
});


/**
 * Upper body parts
 */
PartRepository::share('upper_body.menu', function($view)
{
    // Don't show if categories are empty
    $view->dontShowIf($view->estateCategories->isEmpty());
});

PartRepository::share('upper_body.latest_news', function($view)
{
    $view->latestNews = App::make('News')->first();

    // Dont show if latest news is null
    $view->dontShowIf($view->latestNews == null);
});



/**
 * Inner body parts
 */
PartRepository::share('inner_body.special_offers', function($view)
{
    $view->specials = App::make('Estate\EstateAlgorithm')->specials()->orderByDate()->accepted()->take(4)->get();

    $view->dontShowIf($view->specials->isEmpty());
});

PartRepository::share('inner_body.slider', function($view)
{
    $view->sliders = App::make('Slider')->get();

    $view->dontShowIf($view->sliders->isEmpty());
});