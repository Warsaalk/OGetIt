<?php
/*
 * Copyright © 2015 Klaas Van Parys
 * 
 * This file is part of OGetIt.
 * 
 * OGetIt is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * OGetIt is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public License
 * along with OGetIt.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace OGetIt\Exception;

class OGetIt_API_Exception extends \Exception {
	
	const INVALID_VERSION = 4000;
	const INVALID_API_KEY = 4001;
	const INVALID_API_KEY_EXPIRED = 4002;
	const INVALID_API_PERMISSION = 4003;
	const INVALID_PATH = 4004;
	const INTERNAL_ERROR = 5000;
	const INVALID_CR_ID = 6000;
	
	/**
	 * @var string
	 */
	private $_prefix = 'OGame API error: ';
	
	/**
	 * @param string $message
	 * @param number $code
	 * @param Exception $previous
	 */
	public function __construct($code = 0, $message = "Unknown exception" , Exception $previous = null) {
	
		switch ($code) {
			
			case self::INVALID_VERSION:
				$message = 'Invalid version';
				break;
				
			case self::INVALID_API_KEY:
				$message = 'Invalid API key';
				break;
				
			case self::INVALID_API_KEY_EXPIRED:
				$message = 'API key expired';
				break;
				
			case self::INVALID_API_PERMISSION:
				$message = 'Invalid API permissions';
				break;
				
			case self::INVALID_PATH: 
				$message = 'Invalid path';
				break;
				
			case self::INTERNAL_ERROR: 
				$message = 'Internal server error';
				break;
				
			case self::INVALID_CR_ID:
				$message = 'Invalid combat report';
				break;
			
		}
		
		parent::__construct($this->_prefix . $message, $code, $previous);
		
	}
	
}