<?php namespace Kareem3d\FreakLink;

use Illuminate\Support\ServiceProvider;
use Kareem3d\Freak\ClientRepository;
use Kareem3d\Freak\PackageRepository;

class FreakLinkServiceProvider extends ServiceProvider {

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
		$this->package('kareem3d/freak-link');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        ClientRepository::register(new LinkClient());
        PackageRepository::register(new LinkPackage());
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