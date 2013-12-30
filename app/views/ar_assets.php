<?php

return array(

    array('template' => 'main',
          'css' => 'app/css/style.css',
          'js'  => array( 'app/lib/jquery.min.js',
                          'app/lib/respond.min.js',
                          'http://code.angularjs.org/1.2.0rc1/angular.min.js',
                          'app/js/app.js')),

    array('part' => 'inner_body.slider',
          'css'  => 'app/lib/news-slider/style.css',
          'js'   => 'app/lib/news-slider/jquery.news-slider.js'),


    array('part' => 'inner_body.under_construction',
          'js'   => array('app/lib/countdown/jquery.countdown.js', 'app/lib/countdown/script.js'),
          'css'  => array('app/lib/countdown/jquery.countdown.css', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300')),

    array('part' => 'inner_body.one_estate',
          'js'   => 'app/lib/simple-slider/slider.min.js'),
);