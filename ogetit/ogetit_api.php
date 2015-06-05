<?php

namespace OGetIt;

use OGetIt\Http\OGetIt_HttpRequest;

class OGetIt_Api { 
	
	/**
	 * @var string
	 */
	const TYPE_COMBATREPORT = 'combat/report';

	/**
	 * @param integer $error
	 * @throws OGetIt_Exception
	 */
	private static function processError($error) {
	
		throw new OGetIt_Exception($error);
	
	}
	
	/**
	 * @param string $url
	 * @return mixed
	 * @throws OGetIt_Exception
	 */
	public static function getData($url, $username = false, $password = false) {
		
		$request = new OGetIt_HttpRequest($url);
		
		if ($username !== false && $password !== false) {
			$request->useAuthentication($username, $password);
		}
		
		$reponse = $request->send(true);
		
		$reponseData = json_decode($reponse, true);
		
		if ($reponseData['RESULT_CODE'] === 1000) {
			return $reponseData['RESULT_DATA'];
		} else {
			self::processError($reponseData['RESULT_CODE']);
		}
		
	}
	
	/**
	 * @param string $path
	 * @param array $query
	 * @return string
	 */
	public static function constructUrl($path, OGetIt $ogetit, array $get = array()) {
				
		$url = "//s{$ogetit->getUniverseID()}-{$ogetit->getCommunity()}.ogame.gameforge.com/api/{$ogetit->getApiVersion()}/$path";
		
		if (!empty($get)) {
			$url .= '?' . http_build_query($get);
		}
		
		return ($ogetit->usesHttps() ? "https:" : "http:") . $url;
		
	}
	
}