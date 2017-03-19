<?php
namespace Vbt\Core;

/**
 * Heandle Response
 */
class Response
{
	public function __construct($content)
	{
		echo $content;
	}

	public static function header()
	{

	}

	public static function setcookie($name, $value)
	{
		setcookie($name, $value, time() + 3600, '/');
	}
}
?>