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

        $this->app->singleton('Kareem3d\Templating\Factory', function()
        {
            if(Config::get('templating::use') === 'xml')
            {
                return XMLFactory::instance(Config::get('templating::xml.pages'), Config::get('templating::xml.assets'));
            }
            else
            {
                return ArrayFactory::instance(Config::get('templating::array.pages'), Config::get('templating::array.assets'));
            }
        });
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