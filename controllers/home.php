<?php
namespace Vbt\Controllers;

use Vbt\Core\Controller;

/**
 * Home controller
 */
class Home extends Controller
{
	/**
	 * The class constructor
	 */
	public function __construct()
	{
		// Call the parent class constructor
		parent::__construct();
	}
	/**
	 * Intex Method
	 */
	public function index()
	{
		echo 'Hello World';
	}
}
?>