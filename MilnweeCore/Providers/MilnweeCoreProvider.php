<?php

namespace MilnweeCore\Providers;

use Illuminate\Support\ServiceProvider;

class MilnweeCoreProvider extends ServiceProvider
{

	use \Illuminate\Console\AppNamespaceDetectorTrait;

	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function boot()
	{
		// load in the milnwee routes
		require __DIR__ . DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR .'milnwee_core_routes.php';

		$controllers = array();

		// set a config of all the milnwee core enabled controllers
		$controllerPath = app_path() . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'Controllers';
		foreach (glob($controllerPath . DIRECTORY_SEPARATOR . '*.php') as $filename)
		{
			$className = substr(basename($filename), 0, -4);

			// we dont wanna do the initial laravel controller anyway
			if ($className == 'Controller') {
				continue;
			}
			// workout the full classname
			$className = $this->getAppNamespace() . 'Http' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . $className;
			// check if we're using milnweecore
			$parentClass = get_parent_class($className);
			// if we are...
			if ($parentClass == 'MilnweeCore' . DIRECTORY_SEPARATOR .'Controllers' . DIRECTORY_SEPARATOR .'MilnweeCoreController') {
				$class = new $className();

				// as long as we're not disallowing this controller, add it to the array

				$controllers[$class->getModelShortName()] = 'admin.' . $class->getRouteKey() . '.index';
			}
		}

		if (!empty($controllers)) {
			\Config::set('milnwee', array(
				'controllers' => $controllers
			));
		}
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
