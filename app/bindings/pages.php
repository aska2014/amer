<?php

use Kareem3d\Templating\PageRepository;

PageRepository::share('all-estates', function($view)
{
    $category = $view->link->getModel();

    if($parent = $category->parent)
    {
        $view->estatesTitle = $parent->title . ' > ' . $category->title;
    }
    else
    {
        $view->estatesTitle = $category->title;
    }

    $view->estates = App::make('EstateAlgorithm')->underCategory($category)->get();
});


PageRepository::share('one-estate', function($view)
{
    $view->estate = $view->link->getModel();
});


PageRepository::share('all-news', function($view)
{
    $view->news = App::make('News')->all();
});


PageRepository::share('one-news', function($view)
{
    $view->oneNews = $view->link->getModel();
});


PageRepository::share('one-slider', function($view)
{
    $view->slider = $view->link->getModel();
});
