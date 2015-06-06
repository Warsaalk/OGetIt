<?php

namespace OGetIt\Exception;

class OGetIt_cURL_Exception extends \Exception {
	
	private $_prefix = 'cURL error: ';
	
	/**
	 * @param string $message
	 * @param number $code
	 * @param Exception $previous
	 */
	public function __construct($message = "Unknown exception", $code = 0, Exception $previous = null) {
		
		parent::__construct($this->_prefix . $message, $code, $previous);
		
	}
	
}