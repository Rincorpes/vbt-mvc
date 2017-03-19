<?php
namespace Vbt\Config;

/**
 * Config Class
 */
class Config
{
	/**
	 * Saves the configs
	 *
	 * @var array
	 */
	private $_configs = array();

	/**
	 * The class constructor.
	 * You can pass your default configs when you call this class
	 * If not, the default constans will be used.
	 * You can also modify the default constans in global.php
	 *
	 * * @param $params array Your default configs
	 */
	function __construct($params = array())
	{
		// Default name for the base url controller
		$this->default_controller = (in_array('default_controller', $params)) ? $params['default_controller'] : DEFAULT_CONTROLLER;
		// the method will be executed if there's not method defined
		// See CORE_PATH . 'router.php'
		$this->default_method = (in_array('default_method', $params)) ? $params['default_method'] : DEFAULT_METHOD;

		$this->default_template = (in_array('default_template', $params)) ? $params['default_template'] : DEFAULT_TEMPLATE;
	}
	/**
	 * set properties
	 *
	 * @param string $name Name for the config poperty
	 * @param mixed $value Its value
	 */
	public function __set($name, $value)
	{
		$this->_configs[$name] = $value;
	}
	/**
	 * Returns properties
	 *
	 * @param string $name Name of the property
	 * @return boolean|mixed
	 */
	public function __get($name)
	{
		return (isset($this->_configs[$name])) ? $this->_configs[$name] : false;
	}
	/**
	 * Checks if the property has been setted
	 *
	 * @param string $name The name of the property
	 * @return boolean
	 */
	public function __isset($name)
	{
		return (array_key_exists($name, $this->_configs)) ? true : isset($this->_configs[$name]);
	}
	/**
	 * Destroyes properties
	 *
	 * @param string $name The name of the property
	 * @return boolean
	 */
	public function __unset($name)
	{
		if (isset($this->_configs[$name]))
			unset($this->_configs[$name]);
	}
}
?>