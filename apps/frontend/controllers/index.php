<?php
namespace Vbt\Apps\Frontend\Controllers;

use Vbt\Core\Controller;

/**
 * Index controller for frontend
 */
class Index extends Controller
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
		$this->response('Hello World!');
	}
}
?>