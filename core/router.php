<?php
namespace Vbt\Core;

use Vbt\Core\Request,
	Vbt\Helpers\Fn;

/**
 * Processes the urls to define the name of the controller, the method and
 * the arguments (if any) that will be used.
 *
 * To do this, it takes the value stored in $ _GET ['url'] using htaccess,
 * converts it into an array and processes it in the constructor.
 */
class Router
{
	/**
	 * Name of the controller that will be used
	 *
	 * @var string
	 */
	private $_controller;
	/**
	 * Name of the method that will be excecuted in the controller class
	 *
	 * @var string
	 */
	private $_method;
	/**
	 * Arguments, if they exist that will be passed to the method
	 *
	 * @var array
	 */
	private $_arguments;

	/**
	 * The class constructor
	 *
	 * @param $configs Array The configs setted in CONFIG_PATH . config.php
	 */
	public function __construct($configs)
	{
		// If thers a value stored in $_GET['url']
		if (Request::get('url')) {
			$url = array();

			// Proccess the url
			$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			$url = array_filter($url);

			// If there are dashes
			foreach ($url as $str) {
				$arr[] = Fn::vbt_dash_2_camel_case($str);
			}

			$url = $arr;

			// Get the values for the properties
			$this->_controller = array_shift($url);
			$this->_method = array_shift($url);
			$this->_arguments = $url;
		}

		// If there's no controller taken from the url
		if (!$this->_controller) $this->_controller = $configs['default_controller'];

		// If there's no method taken from the url
		if (!$this->_method) $this->_method = $configs['default_method'];

		// If there's no Aarguments taken from the url
		if (!isset($this->_arguments)) $this->_arguments = array();
	}
	/**
	 * Auto call methods
	 * With this, you can call Any method that begins with "get" or "set"
	 *
	 * @param $method string The name for the method
	 * @param $arguments array The arguments in an array
	 * @return void|string
	 */
	public function __call($method, $arguments)
	{
		// Get the first three letters as thr prefix (It sould be get or set)
		$prefix = strtolower(substr($method, 0, 3));
		// Save the name of the property adding a "_" at the begining
		$property = '_' .strtolower(substr($method, 3));

		// If there's no prefix or property name, doesn't do anything
		if (empty($prefix) || empty($property)) return;
		// If $prefix is 'get' and ther's property returns its name
		if ($prefix == 'get' && isset($this->$property)) return $this->$property;
		// If $prefix is "set" the property equals the arguments
		if ($prefix == 'set') $this->$property = $arguments[0];
	}
}
?>