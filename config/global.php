<?php
/**
 * Global Configs
 */
/**
 * Root directory of the app. it's supposed to be the parent
 * directory of config directory.
 *
 * You can modify this if you run the app in another dir
 *
 * @var ROOT string
 */
defined('ROOT') or define('ROOT', dirname(__DIR__));
/**
 * @var CONFIG_PATH string Path to the config directory
 */
define('CONFIG_PATH', ROOT . '/config');
/**
 * Path to the app core directory
 *
 * @var string 
 */
define('CORE_PATH', ROOT . '/core');
/**
 * Path to the apps dir
 *
 * @var string
 */
define('APPS_PATH', ROOT . '/apps');
/**
 * Path to the apps dir
 *
 * @var string
 */
define('MODULES_PATH', ROOT . '/modules');
/**
 * Path to the helper functions dir
 *
 * @var string
 */
define('FUNCTIONS_PATH', ROOT . '/helpers/functions');

/**
 * name for the deault App
 *
 * @var string
 */
define('DEFAULT_APP', 'frontend');
/**
 * name for the deault Controller
 *
 * @var string
 */
define('DEFAULT_CONTROLLER', 'index');
/**
 * The name for the default method of any controller
 *
 * @var string
 */
define('DEFAULT_METHOD', 'index');
?>