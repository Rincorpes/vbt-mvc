<?php
/**
 * Global Configs
 */

/**
 * Paths
 */

/**
 * Directory Separator. Do not modify
 *
 * @var DS constant 
 */
if (! defined('DS'))
	define('DS', DIRECTORY_SEPARATOR);
/**
 *  Root directory of the app. it's supposed to be the parent
 * directory of config directory.
 *
 * You can modify this if you run the app in another dir
 *
 * @var ROOT string
 */
if (! defined('ROOT'))
	define('ROOT', dirname(__DIR__) . DS);
/**
 * @var CONFIG_PATH string Path to the config directory
 */
if (! defined('CONFIG_PATH'))
	define('CONFIG_PATH', ROOT . 'config' . DS);
/**
 * Path to the app core directory
 *
 * @var string 
 */
define('CORE_PATH', ROOT . 'core' . DS);
/**
 * Path to the lib directory
 *
 * @var string
 */
define('LIB_PATH', ROOT . 'lib' . DS);
/**
 * Path to the controllers dir
 *
 * @var string
 */
define('CONTROLLERS_PATH', ROOT . 'controllers' . DS);
/**
 * Path to the helper functions dir
 *
 * @var string
 */
define('FUNCTIONS_PATH', ROOT . 'helpers' . DS . 'functions' . DS);
/**
 * Defaults
 */
/**
 * name for the deault Controller
 *
 * @var string
 */
define('DEFAULT_CONTROLLER', 'home');
/**
 * The name for the default method of any controller
 *
 * @var string
 */
define('DEFAULT_METHOD', 'index');
/**
 * Name for the default Template
 *
 * @var string
 */
define('DEFAULT_TEMPLATE', 'vbt');
?>