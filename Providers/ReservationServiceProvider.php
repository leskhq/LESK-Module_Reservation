<?php
namespace App\Modules\Reservation\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class ReservationServiceProvider extends ServiceProvider
{
	/**
	 * Register the Reservation module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Reservation\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Reservation module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('reservation', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('reservation', base_path('resources/views/vendor/reservation'));
		View::addNamespace('reservation', realpath(__DIR__.'/../Resources/Views'));
	}

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
		// $this->addMiddleware('');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('reservation.php'),
        ], 'config');

        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'reservation'
        );
    }

	/**
     * Register the Middleware
     *
     * @param  string $middleware
     */
	protected function addMiddleware($middleware)
	{
		$kernel = $this->app['Illuminate\Contracts\Http\Kernel'];
        $kernel->pushMiddleware($middleware);
	}
}
