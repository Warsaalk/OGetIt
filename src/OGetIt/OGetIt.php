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
namespace OGetIt;

use OGetIt\Http\HttpRequest;
use OGetIt\Report\CombatReport\CombatReport;
use OGetIt\Report\HarvestReport\HarvestReport;
use OGetIt\Report\SpyReport\SpyReport;
use OGetIt\Report\MissileReport\MissileReport;

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
	 * @param string $apikey
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
	
	private function getApiData($type, $label, $key, $username = false, $password = false) {
		
		$url = OGameApi::constructUrl($type, $this, array(
			'api_key' => $this->_apikey,
			$label => $key
		));
		
		return OGameApi::getData($url, $username, $password); 
		
	}
	
	/**
	 * @param string $type
	 * @param array $data
	 * @return CombatReport|SpyReport|HarvestReport|SpyReport
	 */
	private function getReport($type, $data) {
		
		if ($data !== false) {
		
			switch ($type) {
				case OGameApi::TYPE_COMBATREPORT:
					return CombatReport::createCombatReport($data);
					
				case OGameApi::TYPE_HARVESTREPORT:
					return HarvestReport::createHarvestReport($data);
					
				case OGameApi::TYPE_MISSILEREPORT:
					return MissileReport::createMissileReport($data);
					
				case OGameApi::TYPE_SPYREPORT:
					return SpyReport::createSpyReport($data);
				
				default;
			}
		
		}
		
		return false;
		
	}
	
	/**
	 * @param string $cr_api_key
	 * @return CombatReport
	 */
	public function getCombatReport($cr_api_key, $username = false, $password = false) {
		
		$type = OGameApi::TYPE_COMBATREPORT;
		$data = $this->getApiData($type, 'cr_id', $cr_api_key, $username, $password);
				
		return $this->getReport($type, $data);
		
	}
	
	/**
	 * @param string $json
	 * @return CombatReport
	 */
	public function getCombatReportFromJSON($json) {
		
		return $this->getReport(OGameApi::TYPE_COMBATREPORT, json_decode($json));
		
	}
	
	/**
	 * @param string $rr_api_key
	 * @return HarvestReport
	 */
	public function getHarvestReport($rr_api_key, $username = false, $password = false) {
		
		$type = OGameApi::TYPE_HARVESTREPORT;
		$data = $this->getApiData($type, 'rr_id', $rr_api_key, $username, $password);
		
		return $this->getReport($type, $data);
		
	}
	
	/**
	 * @param string $json
	 * @return HarvestReport
	 */
	public function getHarvestReportFromJSON($json) {
		
		return $this->getReport(OGameApi::TYPE_HARVESTREPORT, json_decode($json));
		
	}
	
	/**
	 * @param string $sr_api_key
	 * @return SpyReport
	 */
	public function getSpyReport($sr_api_key, $username = false, $password = false) {
		
		$type = OGameApi::TYPE_SPYREPORT;
		$data = $this->getApiData($type, 'sr_id', $sr_api_key, $username, $password);
				
		return $this->getReport($type, $data);
		
	}
	
	/**
	 * @param string $json
	 * @return SpyReport
	 */
	public function getSpyReportFromJSON($json) {
		
		return $this->getReport(OGameApi::TYPE_SPYREPORT, json_decode($json));
		
	}
	
	/**
	 * @param string $mr_api_key
	 * @return MissileReport
	 */
	public function getMissileReport($mr_api_key, $username = false, $password = false) {
		
		$type = OGameApi::TYPE_MISSILEREPORT;
		$data = $this->getApiData($type, 'mr_id', $mr_api_key, $username, $password);
				
		return $this->getReport($type, $data);
		
	}
	
	/**
	 * @param string $json
	 * @return MissileReport
	 */
	public function getMissileReportFromJSON($json) {
		
		return $this->getReport(OGameApi::TYPE_MISSILEREPORT, json_decode($json));
		
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