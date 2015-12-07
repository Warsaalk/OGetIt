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
use OGetIt\Exception\ApiException;

class OGameApiXML { 

	/**
	 * @var string
	 */
	const TYPE_SERVERDATA = 'serverData';
	
	/**
	 * @var integer
	 */
	private static $connection_timeout = 0;
	
	/**
	 * @param integer $seconds
	 */
	public static function setMaxConnectionTimeout($seconds) {
		
		self::$connection_timeout = $seconds;
		
	}
	
	/**
	 * @param integer $error
	 * @throws Exception
	 */
	private static function processError($error) {
	
		throw new ApiException($error);
	
	}
	
	/**
	 * @param string $url
	 * @param string $username
	 * @param string $password
	 * @return \SimpleXMLElement|boolean
	 * @throws Exception
	 */
	public static function getData($url, $username = false, $password = false) {
		
		$request = new HttpRequest($url, self::$connection_timeout);
		
		if ($username !== false && $password !== false) {
			$request->useAuthentication($username, $password);
		}
		
		$response = $request->send(true);
		
		if ($response !== false) {
		
			return simplexml_load_string($response);
					
		}
		
		return false;
		
	}
	
	/**
	 * @param string $path
	 * @param OGetIt $ogetit
	 * @param array $query
	 * @return string
	 */
	public static function constructUrl($path, OGetIt $ogetit, array $get = array()) {
				
		$url = "//s{$ogetit->getUniverseID()}-{$ogetit->getCommunity()}.ogame.gameforge.com/api/$path.xml";
		
		if (!empty($get)) {
			$url .= '?' . http_build_query($get);
		}
		
		return ($ogetit->usesHttps() ? "https:" : "http:") . $url;
		
	}
	
}