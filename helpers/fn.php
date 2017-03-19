<?php
namespace Vbt\Helpers;

use Exception;

/**
 * Class to load app functions using its namespace
 */
class Fn
{
	/**
	 * Load the function
	 */
	public static function __callStatic($fn, $args)
	{
		if (! function_exists($fn)) {
			// The path to the function in the functions directory
			$fnPath = __DIR__ . DS . 'functions' .DS . $fn . '.php';

			if (is_readable($fnPath)) {
				// Require the file only once
				require_once $fnPath;

				// Set the function namespace
				$fn = 'Vbt\\Helpers\\Functions\\' . $fn;

				// Call the function
				if (! empty($args))
					return call_user_func_array($fn, $args);
				else
					call_user_func($fn);
			} else {
				throw new Exception('The file ' . $fnPath . ' does not exists', 1);
			}
		}
	}
}
?>