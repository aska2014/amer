<?php

use Illuminate\Support\Facades\App;
use Kareem3d\Templating\PageRepository;
use Kareem3d\Templating\Part;
use Kareem3d\Templating\PartRepository;

PageRepository::shareToAll(function($view)
{
    if($seo = App::make('Kareem3d\Marketing\SEO')->getByUrl(App::make('CurrentLink')->getUrl()))
    {
        $view->seo = $seo;
    }
});

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
 * header parts
 */
PartRepository::share('header.top', function($view)
{
    $view->menuPages = App::make('Website\Page')->getTopMenu();
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
    $view->latestNews = App::make('News')->getRandomLatest();

    // Dont show if latest news is null
    $view->dontShowIf($view->latestNews == null);
});



/**
 * Inner body parts
 */
PartRepository::share('inner_body.special_offers', function($view)
{
    $view->specials = App::make('Estate\EstateAlgorithm')->language()->specials()->orderByDate()->accepted()->take(4)->get();

    $view->dontShowIf($view->specials->isEmpty());
});

PartRepository::share('inner_body.slider', function($view)
{
    $view->sliders = App::make('Slider')->orderBy('created_at', 'DESC')->take(15)->get();

    $view->dontShowIf($view->sliders->isEmpty());
});

PartRepository::share('inner_body.advertisement', function($view)
{
    $view->bodyBanner = App::make('Website\BannerAlgorithm')->active()->place('body')->recent()->first();
});

PartRepository::share('sidebar.advertisement', function($view)
{
    $view->maximumSideBanners = 2;

    $view->sideBanners = App::make('Website\BannerAlgorithm')->active()->place('sidebar')->recent()->take(2)->get();
});

PartRepository::share('sidebar.menu', function($view)
{
    $view->realEstateInvestmentPage = App::make('Website\Page')->getRealEstateInvestment();
});

/**
 * Footer parts
 */

PartRepository::share('footer.contacts', function($view)
{
    $view->mobileNumbers = App::make('Website\ContactInfo')->getMobileNumbers(2);
    $view->contactEmail = App::make('Website\ContactInfo')->getMainEmail();
});

PartRepository::share('footer.special', function($view)
{
    $view->footerSpecial = App::make('Estate\EstateAlgorithm')->language()->specials()->random()->first();

    $view->dontShowIf($view->footerSpecial == null);
});