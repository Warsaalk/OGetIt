<?php

namespace OGetIt\CombatReport;

use OGetIt\CombatReport\OGetIt_CombatRound_Stats;

class OGetIt_CombatRound {
		
	/**
	 * @var integer
	 */
	private $_number;
	
	/**
	 * @var OGetIt_CombatRound_Stats
	 */
	private $_statistics;

	public function __construct($number, $statistics) {
		
		$this->_number = $number;
		
		$this->_statistics = OGetIt_CombatRound_Stats::createInstance($statistics);

	}
		
}