<?php
namespace Vbt\Core;

use Vbt\Core\VBTException,
	Vbt\Core\Registry,
	Vbt\Core\Error,
	Vbt\Core\Router;

/**
 * Runs the App
 */
class Init
{
	/**
	 * Saves the namespace
	 *
	 * @var string
	 */
	private $_namespace;
	/**
	 * Saves the app path
	 *
	 * @var string
	 */
	private $_includePath;
	/**
	 * Saves the Singleton pattern object
	 *
	 * @var object
	 */
	public $_object;

	/**
	 * Assign its relevant value to each property
	 *
	 * @param string $ns The namespace to use
	 * @param string $includePath The path for the namespace
	 * @param boolean $debug If true, this class debug method is called
	 */
	public function __construct($ns = null, $includePath = null, $debug = false)
	{
		$this->_namespace = $ns;
		$this->_includePath = $includePath;

		$this->registerSPL();

		if ($debug) $this->debug();

		require_once ROOT . '/config/global.php';

		$this->_object = Registry::getInstance();

		$this->_object->_router = new Router();
	}
	/**
	 * Register this class loader ($this->loadClass) on the SPL autoload stack.
	 *
	 * @uses spl_autoload_register()
	 */
	private function registerSPL()
	{
		spl_autoload_register(array($this, 'loadClass'));
	}
	/**
	 * Load the given class or interface.
	 *
	 * @param string $className The name for the class to load.
	 * @return void
	 */
	private function loadClass($className)
	{
		// does the class use the namespace?
		$len = strlen($this->_namespace);

		if (strncmp($this->_namespace, $className, $len) != 0) {
			// negative, move to the next registered autoloader
			throw new VBTException('Class ' . $className . ' use not defined in ' . $this->_namespace, 1);
			return;
		}

		// get the relative class name
		$relative_class = substr($className, $len);

		// replace the namespace prefix with the base directory, replace namespace
		// separators with directory separators in the relative class name, append
		// with .php

		$file = $this->_includePath . str_replace('\\', '/', strtolower($relative_class)) . '.php';

		// if the file exists, require it
		if (file_exists($file))
			require $file;
		else
			 throw new VBTException('The class ' . $className . ' does not exists.', 1);
	}
	/**
	 * Call PHP error_reporting() function
	 * and this class setErrorHandlerMethor
	 *
	 * @uses error_reporting()
	 */
	private function debug()
	{
		error_reporting(E_ALL);
		$this->setErrorHandler(array($this, 'errorHandler'));	
	}
	/**
	  * Set the error handler
	  *
	  * @param string $handler Nombre de la función
	  * @uses set_error_handler()
	  */
	private function setErrorHandler($handler)
	{
		ob_start(array($this, 'fatalError'));
		set_error_handler($handler);
	}
	/**
	  * Callback function. Receives the buffer content and search
	  * fon a fatal error..
	  *
	  * @param $buffer string Buffer content
	  * @return mixed Buffer content or this class errorHandler method
	  */
	private function fatalError($buffer)
	{
		$temporal_buffer = $buffer;

		// Se eliminan las etiquetas HTML y PHP del string que esté en el buffer.
		$text = strip_tags($temporal_buffer);

		// e busca error fatal en el buffer por medio de expreciones regulares
		if(preg_match('/Fatal error: (.+) in (.+)? on line (\d+)/', $text, $match))
			return $this->errorHandler($errno = E_ERROR, $errstr = $match[1], $errfile = $match[2], $errline = $match[3], $context = '', true);

		return $buffer; 
	}
	/**
	  * Error handler function. Call Error class and passes it the recived
	  * params. Then return the error message.
	  *
	  * @param $params array Error params
	  * @param boolean $return True If hte message is on the buffer
	  */
	private function errorHandler($errno, $errstr, $errfile, $errline, $context, $return = false)
	{
		$params = array(
			'errno' => $errno,
			'errstr' => $errstr,
			'errfile' => $errfile,
			'errline' => $errline,
			'context' => $context
			);

		$error = new Error($params);

		if ($return) return $error->getMessage();

		echo $error->getMessage();
	}
}
?>