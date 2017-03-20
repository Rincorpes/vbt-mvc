<?php
namespace Vbt\Core;

require_once LIB_PATH . 'smarty' . DS . 'Smarty.class.php';

use Smarty,
	Exception;
/**
 * 
 */
class View extends Smarty
{
	/**
	 * To get the registry object
	 *
	 * @var object
	 */
	private $_registry;
	/**
	 * Saves the current controller
	 *
	 * @var string
	 */
	private $_controller;
	/**
	 * Saves the current method
	 *
	 * @var string
	 */
	private $_method;
	/**
	 * Saves the current arguments if they exist
	 *
	 * @var array
	 */
	private $_arguments;
	/**
	 * Saves the template name
	 *
	 * @var string
	 */
	private $_template;
	/**
	 * The documents extension
	 *
	 * @var array
	 */
	private $_file_ext;
	/**
	 * Saves the item
	 *
	 * @var array
	 */
	private $_item;

	/**
	 * The class Constructopr
	 */
	public function __construct()
	{
		$this->_registry = Registry::getInstance();

		$this->_controller = $this->_registry->_router->getController();
		$this->_method = $this->_registry->_router->getMethod();
		$this->_arguments = $this->_registry->_router->getArguments();

		$this->_path = array();

		$this->_path['view'] = VIEWS_PATH . $this->_controller . DS;

		$this->_template = $this->_registry->_config->default_template;
		$this->_file_ext = '.tpl';
		$this->_item = '';
	}

	public function render($view, $item = null)
	{
		$this->template_dir = VIEWS_PATH . 'layout' . DS . $this->_template . DS;
		$this->config_dir = VIEWS_PATH . 'layout' . DS . $this->_template . DS . 'configs' . DS;
		$this->cache_dir = CACHE_PATH;
		$this->compile_dir = TEMPLATE_COMPILE_PATH ;

		$view_path = $this->_path['view'] . $view . $this->_file_ext;
		$template_path =  $this->template_dir . 'index' . $this->_file_ext;

		if (is_readable($view_path)) {
			if (file_exists($template_path)) {
				$this->assign('_content', $view_path);
			} else {
				throw new Exception('Error processing request. The file ' . $template_path . ' does not exist.', 1);
			}
		} else {
			throw new Exception('Error processing request. The file ' . $view_path . ' does not exist.', 1);
		}

		$this->display('index.tpl');
	}
}
?>