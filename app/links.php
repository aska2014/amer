<?php

use Estate\Estate;
use Estate\EstateCategory;

return array(

    // Home page
    array('home', 'home.html'),

    // Auction page
    array('auction', 'auctions.html'),

    // Slider show
    array('slider/show', 'slider-([0-9]+).html', Slider::getClass()),

    // User estates
    array('user/estates', 'user/estates.html'),

    // Estates
    array('estate/all', 'estates-([0-9]+).html', EstateCategory::getClass()),
    array('estate/show', 'estate-([0-9]+).html', Estate::getClass()),

    // Estate operations
    array('estate/create', 'create-estate.html'),
    array('estate/edit', 'edit-estate/([0-9]+)', Estate::getClass()),
    array('estate/upgrade', 'upgrade-estate/([0-9]+)', Estate::getClass()),
    array('estate/remove', '234eZSCAD34eXZC2W3reds/([0-9]+)', Estate::getClass()),

    // News
    array('news/all', 'all-news.html'),
    array('news/one', 'news-([0-9]+).html', News::getClass()),

    // Login and register show
    array('login/show', 'login-register.html'),

    // Contact us page
    array('contact-us', 'contact-us.html'),

    // Advanced search
    array('advanced-search', 'advanced-search.html')
);