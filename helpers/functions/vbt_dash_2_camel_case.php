<?php
namespace Vbt\Helpers\Functions;

/**
 * Turns dash case into camel case
 */
function vbt_dash_2_camel_case($str)
{
	$str = strtolower($str);
	$str = explode('-', $str);

	if (count($str)) {
		for ($i = 1; $i < count($str); $i++) {
			$str[$i] = ucwords($str[$i]);
		}
	}

	$str = implode('', $str);
	return $str;
}
?>