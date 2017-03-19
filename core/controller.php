<?php
namespace Vbt\Core;

/**
 * Abstract class for All controllers
 */
abstract class Controller
{
	/**
	 * The class constructor
	 */
	public function __construct()
	{
		
	}
	/**
	 * the main method in all controllers
	 */
	protected abstract function index();
}
?>