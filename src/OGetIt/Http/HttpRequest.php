<?php
/*
 * OGetIt, a open source PHP library for handling the new OGame API as of version 6.
 * Copyright (C) 2015  Klaas Van Parys
 * 
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 */
namespace OGetIt\Http;

use OGetIt\Exception\CurlException;

class HttpRequest {
	
	private static $STATE_OPEN = 0, $STATE_CLOSED = 1;
	
	/**
	 * @var string
	 */
	private $url;
	
	/**
	 * @var resource
	 */
	private $resource;
	
	/**
	 * @var mixed
	 */
	private $response;
	
	/**
	 * @var boolean|array
	 */
	private $authentication = false;
	
	/**
	 * @var integer
	 */
	private $state;
	
	/**
	 * @param string $url
	 */
	public function __construct($url, $connection_timeout = 0) {
		
		$this->url = $url;
		$this->state = self::$STATE_OPEN;
		$this->resource = curl_init(); 
		$this->setOption(CURLOPT_CONNECTTIMEOUT, $connection_timeout);
		$this->setOption(CURLOPT_RETURNTRANSFER, true);
		
	}
	
	/**
	 * @param string $username
	 * @param string $password
	 */
	public function useAuthentication($username, $password) {
		
		$this->authentication = new \stdClass();
		$this->authentication->username = $username;
		$this->authentication->password = $password;
		
	}
	
	private function handleAuthentication() {
		
		if ($this->authentication !== false) {
			$this->setOption(CURLOPT_USERPWD, "{$this->authentication->username}:{$this->authentication->password}");
		
			//Clear the htaccess information
			$this->authentication = false;
		}
		
	}
	
	/**
	 * @param int $option
	 * @param mixed $value
	 * @return boolean
	 */
	public function setOption($option, $value) {
		
		return curl_setopt($this->resource, $option, $value);
		
	}
	
	/**
	 * @return boolean|mixed
	 */
	public function send($finish = false) {
		
		$this->handleAuthentication();
		$this->setOption(CURLOPT_URL, $this->url);
		
		$this->response = curl_exec($this->resource);
		
		//If the request fails, save the last error
		if ($this->response === false) {
			throw new CurlException(curl_error($this->resource), curl_errno($this->resource));
		}
		
		if ($finish === true) $this->close();
		
		return $this->response;
		
	}
	
	public function close() {
		
		if ($this->state !== self::$STATE_CLOSED) {
			$this->state = self::$STATE_CLOSED;
			curl_close($this->resource);
		}
		
	}
	
	public function __destruct() {
		
		$this->close();
		
	}
	
}