<?php
namespace Vbt\Core;

use Exception,
	Vbt\Core\Logger;
	
/**
 * Vbt exceptions
 */
class VBTException extends Exception
{
	/**
	 * Get exception and Log the message
	 *
	 * @return string Message
	 */
	public function getError()
	{
		$message = $this->getMessage();

		Logger::log($message);
		
		return $message;
	}
}
?>