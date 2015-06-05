<?php

namespace OGetIt\Http;

class OGetIt_HttpRequest {
	
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
	 * @return boolea|mixed
	 */
	public function send($finish = false) {
		
		$this->handleAuthentication();
		$this->setOption(CURLOPT_URL, $this->_url);
		
		$this->_response = curl_exec($this->_resource);
		
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