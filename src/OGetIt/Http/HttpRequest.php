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
namespace OGetIt\Http;

use OGetIt\Exception\cURL_Exception;

class HttpRequest {
	
	private static $STATE_OPEN = 0, $STATE_CLOSED = 1;
	
	/**
	 * @var string
	 */
	private $_url;
	
	/**
	 * @var resource
	 */
	private $_resource;
	
	/**
	 * @var mixed
	 */
	private $_response;
	
	/**
	 * @var boolean|array
	 */
	private $_authentication = false;
	
	/**
	 * @var integer
	 */
	private $_state;
	
	/**
	 * @param string $url
	 */
	public function __construct($url) {
		
		$this->_url = $url;
		$this->_state = self::$STATE_OPEN;
		$this->_resource = curl_init(); 
		$this->setOption(CURLOPT_RETURNTRANSFER, true);
		
	}
	
	/**
	 * @param string $username
	 * @param string $password
	 */
	public function useAuthentication($username, $password) {
		
		$this->_authentication = new \stdClass();
		$this->_authentication->username = $username;
		$this->_authentication->password = $password;
		
	}
	
	private function handleAuthentication() {
		
		if ($this->_authentication !== false) {
			$this->setOption(CURLOPT_USERPWD, "{$this->_authentication->username}:{$this->_authentication->password}");
		
			//Clear the htaccess information
			$this->_authentication = false;
		}
		
	}
	
	/**
	 * @param int $option
	 * @param mixed $value
	 * @return boolean
	 */
	public function setOption($option, $value) {
		
		return curl_setopt($this->_resource, $option, $value);
		
	}
	
	/**
	 * @return boolean|mixed
	 */
	public function send($finish = false) {
		
		$this->handleAuthentication();
		$this->setOption(CURLOPT_URL, $this->_url);
		
		$this->_response = curl_exec($this->_resource);
		
		//If the request fails, save the last error
		if ($this->_response === false) {
			throw new cURL_Exception(curl_error($this->_resource), curl_errno($this->_resource));
		}
		
		if ($finish === true) $this->close();
		
		return $this->_response;
		
	}
	
	public function close() {
		
		if ($this->_state !== self::$STATE_CLOSED) {
			$this->_state = self::$STATE_CLOSED;
			curl_close($this->_resource);
		}
		
	}
	
	public function __destruct() {
		
		$this->close();
		
	}
	
}