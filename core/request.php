<?php
namespace Vbt\Core;

/**
 * Class to handle requests
 */
class Request
{
	/**
	 * Handles get petitions
	 *
	 * @param string $index The index of $_GET that will be used
	 * @return boolean|string
	 */
	public static function get($index = null)
	{
		if ($index) return isset($_GET[$index]) ? $_GET[$index] : false;
		return $_GET;
	}
}
?>