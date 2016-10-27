<?php
namespace App\Modules\Reservation\Providers;

use Sroutier\LESKModules\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
	/**
	 * This namespace is applied to the controller routes in your module's routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Modules\Reservation\Http\Controllers';

	/**
	 * Define your module's route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		$this->addRouteMiddleware([
        	//
        ], $router);

        $this->addMiddlewareGroups([
        	'web' => [],
        	'api' => []
        ], $router);

		parent::boot($router);

		//
	}

	/**
	 * Define the routes for the module.
	 *
	 * @param  \Illuminate\Routing\Router $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require (config('modules.path').'/Reservation/Http/routes.php');
		});
	}

	/**
	 * @param Array
	 * @param \Illuminate\Routing\Router $router
	 */
	protected function addRouteMiddleware($routeMiddleware, Router $router)
	{
		if( is_array($routeMiddleware) && count($routeMiddleware) > 0)
		{
			foreach ($routeMiddleware as $key => $middleware) {
				$router->middleware($key, $middleware);
	        }
		}
	}

	/**
	 * @param Array
	 * @param \Illuminate\Routing\Router $router
	 */
	protected function addMiddlewareGroups($middlewareGroups, Router $router)
	{
		if( is_array($middlewareGroups) && count($middlewareGroups) > 0)
		{
			foreach ($middlewareGroups as $key => $groupMiddleware) {
				foreach ($groupMiddleware as $middleware) {
					$router->pushMiddlewareToGroup($key, $middleware);
				}
	        }
		}
	}
}
