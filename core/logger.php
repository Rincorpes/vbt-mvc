<?php
namespace Vbt\Core;

/**
 * Logger
 */
class Logger
{
	/**
	 * Receive the message and log it into the exceptions log file
	 * With the date
	 *
	 * @param $message String The exception message
	 */
	public static function log($message)
	{
		$text = '-> ' . date('d-m-Y H:i:s') . ' : ' . $message;

		$handle = (!file_exists(ROOT . '/log/log.txt')) ? fopen(ROOT . '/log/log.txt', 'w') : fopen(ROOT . '/log/log.txt', 'a+');
		fwrite($handle, $text . "\r");
		fwrite($handle, '------------------' . "\r\n");
		fclose($handle);
	}
}
?>