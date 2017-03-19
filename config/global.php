<?php
/**
 * Global Configs
 */

/**
 * @var DS constant Directory Separator
 */
if (! defined('DS'))
	define('DS', DIRECTORY_SEPARATOR);
/**
 * @var ROOT string Root directory of the app. it's supposed to be
 * the parent directory of config directory
 */
if (! defined('ROOT'))
	define('ROOT', dirname(__DIR__) . DS);
/**
 * @var CONFIG_PATH string Path to the config directory
 */
if (! defined('CONFIG_PATH'))
	define('CONFIG_PATH', ROOT . 'config' . DS);
/**
 * @var string path to the app core directory
 */
define('CORE_PATH', ROOT . 'core' . DS);
?>