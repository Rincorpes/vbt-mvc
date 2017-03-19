<?php
namespace Vbt\Core;

/**
 * Save all objects to an array and use Singleton patter
 * to avoid multiple instances of any class
 */
class Registry
{
	/**
	 * The object instance
	 *
	 * @var object
	 */
	private static $_instance;
	/**
	 * Saves the objects list
	 *
	 * @var array
	 */
	private $_data;

	/**
	 * get the object Instance
	 *
	 * @return object
	 */
	public static function getInstance()
	{
		if(!self::$_instance instanceof self) {
			self::$_instance = new Registry();
		}

		return self::$_instance;
	}
	/**
	 * Save the object as value of $this->_data
	 *
	 * @param $name string The name of the object
	 * @param $value object Te object
	 */
	public function __set($name, $value)
	{
		$this->_data[$name] = $value;
	}
	/**
	 * Get the object by the name it was saved
	 *
	 * @param $name string The name of the object
	 * @return object|void
	 */
	public function __get($name)
	{
		if(isset($this->_data[$name])) {
			return $this->_data[$name];
		}

		return false;
	}
}
?>