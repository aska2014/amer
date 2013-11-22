<?php namespace Kareem3d\FreakSeo;

use Illuminate\Support\ServiceProvider;
use Kareem3d\Freak\ClientRepository;
use Kareem3d\Freak\PackageRepository;
use Kareem3d\Marketing\SEO;

class FreakSeoServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    /**
     *
     */
    public function boot()
    {
        $this->package('kareem3d/freak-seo');
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        ClientRepository::register(new SEOClient());
        PackageRepository::register(new SEOPackage());
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