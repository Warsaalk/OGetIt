<?php

namespace OGetIt\Exception;

class OGetIt_Exception extends \Exception {
	
	/**
	 * @param string $message
	 * @param number $code
	 * @param Exception $previous
	 */
	public function __construct($message, $code = 0, Exception $previous = null) {
		
		parent::__construct($message, $code, $previous);
		
	}
	
}