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

defined('ROOT') or define('ROOT', __DIR__);

require_once ROOT . '/core/init.php';

use Vbt\Core\Init,
	Vbt\Core\Bootstrap,
	Vbt\Core\VBTException;

try {
	$vbt = new Init('Vbt', ROOT, true);
	Bootstrap::run($vbt->_object->_router);
} catch (VBTException $e) {
	echo $e->getError();
}
?>