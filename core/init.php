<?php
namespace Vbt\Core;

use Exception,
	Vbt\Core\Registry,
	Vbt\Config\Config;

/**
 * Runs the App
 */
class Init
{
	/**
	 * Saves the Singleton pattern object
	 *
	 * @var object
	 */
	public $_object;

	/**
	 * The class constructor
	 */
	public function __construct()
	{

		// Call static method to register the instance for any class into
		// this class $_object property
		$this->_object = Registry::getInstance();
		$this->_object->_config = new Config();
		// Instance Router passing the configs setted on this parent class
		$this->_object->_router = new Router($this->_object->_config);

		// Run the app passing the Router clas instance
		$this->bootstrap($this->_object->_router);
	}

	private function bootstrap(Router $_router)
	{
		// Get The Controller, Method and Arguments from the Router
		$controller = $_router->getController();
		$method = $_router->getMethod();
		$arguments = $_router->getArguments();

		// Set the controller class name with namespace
		$controllerClassName = ucwords($controller);
		$controllerClassName = 'Vbt\\Controllers\\' . $controllerClassName;

		// set controller path
		$controllerPath = CONTROLLERS_PATH . $controller . '.php';

		if (is_readable($controllerPath)) {

			if (file_exists($controllerPath)) {

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
				throw new Exception('The controller' . $controller . ' does not exists in ' . $controllerPath . '', 1);
			}
		} else {
			throw new Exception('The file ' . $controllerPath . 'does not exists', 1);
		}
	}
}
?>