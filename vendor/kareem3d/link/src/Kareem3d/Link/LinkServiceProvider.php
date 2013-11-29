<?php namespace Kareem3d\Link;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class LinkServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    /**
     *
     */
    public function register()
    {
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
        $this->package('kareem3d/link');

        $this->app->make('Kareem3d\Link\LinkRepository')->addStaticLinks(Config::get('link::links'));
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