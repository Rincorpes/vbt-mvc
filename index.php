<?php
/**
 * Front of the vbt application. This file doesn't make anything but loads
 * the vbt core to make the system works
 *
 * @copyright 2015 - 2017 Vbt
 * @author Santiago Rincón <rincorpes@gmail.com>
 * @link https://twitter.com/rincorpes
 * @version 1.0.0
 */

// Rquire Global Config file
require_once  __DIR__ . '/config/global.php';
// Require Autoload
require_once CORE_PATH . 'autoload.php';

// Classes used in this file
use Vbt\Core\Autoload,
	Vbt\Core\Init;

try {
	// Setup Autoloader
	Autoload::setup('Vbt', ROOT);
	// Initiate Application
	$nit = new Init();
} catch (Exception $e) {
	// if there's an error
	echo $e->getMessage();
}
?>