<?php

use Kareem3d\Templating\PageRepository;

PageRepository::share('all-estates', function($view)
{
    $view->category = $view->link->getModel();
});


PageRepository::share('one-estate', function($view)
{
    $view->estate = $view->link->getModel();
});


PageRepository::share('all-news', function($view)
{
    $view->news = News::all();
});


PageRepository::share('one-news', function($view)
{
    $view->oneNews = $view->link->getModel();
});