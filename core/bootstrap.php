<?php
namespace Vbt\Core;

use Vbt\Core\VBTException,
	Vbt\Core\Router,
	Vbt\Helpers\Fn;

/**
 * Runs the App
 */
class Bootstrap
{
	/**
	 * Run the app.
	 * Load the file of the controller defined by the router and
	 * Create the object, call its method and pass its arguments if
	 * they exists*
	 * 
	 * @param object Router $_router The Router Object.
	 */
	public static function run(Router $_router)
	{
		// Get The Controller, Method and Arguments from the Router
		$app = $_router->getApp();
		$module = $_router->getModule();
		$controller = $_router->getController();
		$method = $_router->getMethod();
		$arguments = $_router->getArguments();

		if (! $module) {
			$appConfig = Fn::vbt_create_path(array(APPS_PATH, $app, 'config', 'config.php'));
			$namespace = 'Vbt\\Apps\\' . ucwords($app) . '\\Controllers\\';
			$controllerPath = Fn::vbt_create_path(array(APPS_PATH, $app, 'controllers', $controller . '.php'));
		} else {
			$namespace = '\\Vbt\\Modules\\' . $module . '\\Controllers\\';
			$controllerPath = Fn::vbt_create_path(array(MODULES_PATH, $module, 'controllers', $controller . '.php'));
		}

		// Set the controller class name with namespace
		$controllerClassName = ucwords($controller);
		$controllerClassName = $namespace . $controllerClassName;

		if (is_readable($controllerPath)) {

			if (file_exists($controllerPath)) {

				if (! $module) require_once $appConfig;

				// Instance the controller
				$controller = new $controllerClassName;

				// Set the method.
				// If the method defined by the Router doesn't exists in the controller
				// We will use the this parent class $_congis default_method.
				$method = (is_callable(array($controller, $method))) ? $_router->getMethod() :  $this->default_method;
				
				// If there's arguments, we will pass them, else, we well call the method with
				// no arguments
				if (isset($arguments))
					call_user_func_array(array($controller, $method), $arguments);
				else
					call_user_func(array($controller, $method));
			} else {
				throw new VBTException('The controller' . $controller . ' does not exists in ' . $controllerPath . '', 1);
			}
		} else {
			throw new VBTException('The file ' . $controllerPath . ' does not exists', 1);
		}
	}
}
?>