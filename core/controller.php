<?php
namespace Vbt\Core;

use Vbt\Core\Response,
	Vbt\Core\View;

/**
 * Abstract class for All controllers
 */
abstract class Controller
{
	/**
	 * The view object
	 *
	 * @var object
	 */
	protected $_view;
	/**
	 * The class constructor
	 */
	public function __construct()
	{
		$this->_view = new View();
	}
	/**
	 * the main method in all controllers
	 */
	protected abstract function index();

	protected function response($content)
	{
		return new Response($content);
	}
}
?>