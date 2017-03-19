<?php
namespace Vbt\Core;

use Exception;

/**
 * Autoload Classes in the whole application
 */
class Autoload
{
	/**
	 * Saves the namespace
	 *
	 * @var string
	 */
	private static $_namespace;
	/**
	 * Saves the app path
	 *
	 * @var string
	 */
	private static $_includePath;

	/**
	 * Assign its relevant value to each prive static property
	 *
	 * @param string $ns The namespace to use
	 * @param string $includePath The path for the namespace
	 */
	public static function setup($ns = null, $includePath = null)
	{
		self::$_namespace = $ns;
		self::$_includePath = $includePath;

		self::register();
	}
	/**
	 * Register this class loader (self::loadClass) on the SPL autoload stack.
	 */
	private static function register()
	{
		spl_autoload_register(array('self', 'loadClass'));
	}
	/**
	 * Load the given class or interface.
	 *
	 * @param string $className The name for the class to load.
	 * @return void
	 */
	private static function loadClass($className)
	{
		// does the class use the namespace?
		$len = strlen(self::$_namespace);

		if (strncmp(self::$_namespace, $className, $len) != 0) {
			// negative, move to the next registered autoloader
			throw new Exception('Class ' . $className . ' use not defined in ' . self::$_namespace, 1);
			return;
		}

		// get the relative class name
		$relative_class = substr($className, $len);

		// replace the namespace prefix with the base directory, replace namespace
		// separators with directory separators in the relative class name, append
		// with .php

		$file = self::$_includePath . str_replace('\\', DS, strtolower($relative_class)) . '.php';

		// if the file exists, require it
		if (file_exists($file))
			require $file;
		else
			 throw new Exception('The file ' . $file . ' does not exists.', 1);
	}
}
?>