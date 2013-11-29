<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

use Kareem3d\Eloquent\Model;
use Tracking\Tracker;

ClassLoader::addDirectories(array(

    app_path().'/libraries',
	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

require app_path('libraries/helpers.php');

\Symfony\Component\Translation\PluralizationRules::set(function( $number )
{
    return ($number == 1) ? 0 : 1;
}, 'ar');

Tracker::instance()->setMechanism(function()
{
   return Request::url();
});

\PathManager\Path::init(URL::to(''), public_path());

// Bind Language and Menu instances
App::instance('Language', new Lan(array('en', 'ar'), 'ar'));

// Set models languages and default language
Model::setLanguages(App::make('Language')->availableLanguages(), App::make('Language')->get());

// Set locale language
App::setLocale(App::make('Language')->get());

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a rotating log file setup which creates a new file each day.
|
*/

$logFile = 'log-'.php_sapi_name().'.txt';

Log::useDailyFiles(storage_path().'/logs/'.$logFile);

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenace mode is in effect for this application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';


// Require freak start file
require app_path() .'/freak/client.php';

if(! $freakManager->freakRequest())
{
    require app_path() .'/ioc.php';
}

// Require bindings files
require app_path('parts.php');
