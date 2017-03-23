<?php
namespace Vbt\Helpers\Functions;

/**
 * Create path from items
 *
 * @param $items array Items
 */
function vbt_create_path($items)
{
	return join('/', $items);
}