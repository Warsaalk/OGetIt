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
namespace OGetIt;

use OGetIt\Http\OGetIt_HttpRequest;
use OGetIt\CombatReport\OGetIt_CombatReport;

class OGetIt { 
	
	/**
	 * @var integer
	 */
	private $_universeID;
	
	/**
	 * @var string
	 */
	private $_community;
	
	/**
	 * @var string
	 * 
	 */
	private $_apikey;
	
	/**
	 * @var string
	 */
	private $_version;
	
	/**
	 * @var boolean
	 */
	private $_https = false;
	
	/**
	 * @param integer $universeID
	 * @param string $community
	 * @param string $version (optional)
	 */
	public function __construct($universeID, $community, $apikey, $version = 'v1') {
		
		$this->_universeID 	= $universeID;
		$this->_community 	= $community;
		$this->_apikey 		= $apikey;
		$this->_version 	= $version;
		
	}
	
	/**
	 * Use https to connect to the API
	 */
	public function useHttps() {
		
		$this->_https = true;
		
	}
	
	/**
	 * @param string $cr_api_key
	 */
	public function getCombatReport($cr_api_key, $username = false, $password = false) {
		
		$url = OGetIt_Api::constructUrl(OGetIt_Api::TYPE_COMBATREPORT, $this, array(
			'api_key' => $this->_apikey,
			'cr_id' => $cr_api_key
		));
		
		$data = OGetIt_Api::getData($url, $username, $password);
				
		return $data === false ? $data : OGetIt_CombatReport::createCombatReport($data);
		
	}
	
	/**
	 * @return integer
	 */
	public function getUniverseID() {
		
		return $this->_universeID;
		
	}
	
	/**
	 * @return string
	 */
	public function getCommunity() {
		
		return $this->_community;
		
	}
	
	/**
	 * @return string
	 */
	public function getApiVersion() {
		
		return $this->_version;
		
	}
	
	/**
	 * @return boolean
	 */
	public function usesHttps() {
		
		return $this->_https;
		
	}
		
}