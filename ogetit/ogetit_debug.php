<?php

namespace OGetIt;

use OGetIt\CombatReport\OGetIt_CombatReport;

class OGetIt_Debug extends OGetIt { 
	
	public function __construct() {}
	
	/**
	 * @param string $dataUrl
	 */
	public function getCombatReport($dataUrl) {

		$data = file_get_contents($dataUrl);
		$data = json_decode($data, true);
				
		return $data === false ? $data : OGetIt_CombatReport::createCombatReport($data['RESULT_DATA']);
		
	}
		
}