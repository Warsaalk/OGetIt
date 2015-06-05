<?php

namespace OGetIt;

use OGetIt\Http\OGetIt_HttpRequest;
use OGetIt\Entity\t202_Small_Cargo;
use OGetIt\CombatReport\OGetIt_CombatReport;

class OGetIt { 
	
	/**
	 * @var string
	 */
	private static $TYPE_COMBATREPORT = 'combat/report';
	
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
	
	private function processError($error) {
		
		return $error;
		
	}
	
	/**
	 * @param string $url
	 * @return mixed
	 */
	private function getDataViaApi($url, $username = false, $password = false) {
		
		$request = new OGetIt_HttpRequest($url);
		
		if ($username !== false && $password !== false) {
			$request->useAuthentication($username, $password);
		}
		
		$reponse = $request->send(true);
		
		$reponseData = json_decode($reponse, true);
		
		if ($reponseData['RESULT_CODE'] === 1000) {
			return $reponseData['RESULT_DATA'];
		} else {
			return $this->processError($reponseData['RESULT_CODE']);
		}
		
	}
	
	/**
	 * @param string $path
	 * @return string
	 */
	private function constructApiUrl($path) {
				
		$url = "s{$this->_universeID}-{$this->_community}.ogame.gameforge.com/api/{$this->_version}/$path?api_key={$this->_apikey}";
		
		return ($this->_https ? "https://" : "http://") . $url;
		
	}
	
	/**
	 * @param string $cr_api_key
	 */
	public function getCombatReport($cr_api_key, $username = false, $password = false) {
		
		$url = $this->constructApiUrl(self::$TYPE_COMBATREPORT) . "&cr_id=$cr_api_key";
		
		$data = $this->getDataViaApi($url, $username, $password);
		
		return OGetIt_CombatReport::createCombatReport($data);
		
	}
	
}