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
	 * Saves current app name
	 *
	 * @var string
	 */
	private $_app;
	/**
	 * Saves current module if it exists
	 *
	 * @var string
	 */
	private $_module;
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
	 * @param $_configs Array The configs setted in CONFIG_PATH . config.php
	 */
	public function __construct()
	{
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
			$this->_module = array_shift($url);

			if ($this->_module) {
				$modules = array();

				$modules_path = Fn::vbt_create_path(array(CONFIG_PATH, 'modules.json'));

				if (file_exists($modules_path))
					$modules = json_decode(file_get_contents($modules_path), true);
				else
					throw new VBTException('The file ' . $modules_path . ' does not exists', 1);
					
				if (count($modules)) {
					if (in_array($this->_module, $modules)) {
						$this->_controller = array_shift($url);
					} else {
						$this->_controller = $this->_module;
						$this->_module = false;
					}
				} else {
					$this->_controller = $this->_module;
					$this->_module = false;
				}
			} else {
				$this->_module = false;
			}
			//$this->_controller = array_shift($url);
			$this->_method = array_shift($url);
			$this->_arguments = $url;

			$apps = array();

			$apps_path = Fn::vbt_create_path(array(CONFIG_PATH, 'apps.json'));

			if (file_exists($apps_path))
				$apps = json_decode(file_get_contents($apps_path), true);
			else
				throw new VBTException('The file ' . $apps_path . ' does not exists', 1);

			if ($apps) {
				foreach ($apps as $key => $value) {
					if (array_key_exists('default_controller', $apps[$key])) {
						if ($this->_controller === $apps[$key]['default_controller']) {
							$this->_app = $key;
							break;
						}
					}
				}
			}
		}

		if (! $this->_app) $this->_app = DEFAULT_APP;

		// If there's no controller taken from the url
		if (!$this->_controller) $this->_controller = DEFAULT_CONTROLLER;

		// If there's no method taken from the url
		if (!$this->_method) $this->_method = DEFAULT_METHOD;

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