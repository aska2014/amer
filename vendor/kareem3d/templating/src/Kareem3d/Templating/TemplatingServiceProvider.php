<?php namespace Kareem3d\Templating;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class TemplatingServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
        $this->package('kareem3d/templating');


            $this->app->singleton('Kareem3d\Templating\XMLFactory', function()
            {
                return XMLFactory::instance(Config::get('templating::xml.pages'), Config::get('templating::xml.assets'));
            });


        // Launch dynamic router
        try{

            // Launch dynamic router
            $this->app->make('Kareem3d\Link\Generator')->dynamicRouter()->launch();

        }catch(\Exception $e){ echo $e->getMessage(); }
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}