<?php
namespace OGetIt\CombatReport;

use OGetIt\Exception\OGetIt_Exception;
use OGetIt\CombatReport\Fleet\OGetIt_Fleet;
use OGetIt\Common\OGetIt_Player;
use OGetIt\CombatReport\Result\OGetIt_CombatResult_RoundDifference;

class OGetIt_CombatReport_Calculator {
	
	/**
	 * @var OGetIt_CombatReport
	 */
	private $_combatreport;
	
	/**
	 * @param OGetIt_CombatReport $combatreport
	 */
	public function __construct(OGetIt_CombatReport $combatreport) {
		
		$this->_combatreport = $combatreport;
		
	}
	
	/**
	 * @param integer $startRound Round number, if 0 it'll use the initial fleet state
	 * @param integer $endRound
	 * @throws OGetIt_Exception
	 * @return OGetIt_CombatParty[]
	 */
	public function getRoundDifference($startRound, $endRound) {
		
		return OGetIt_CombatResult_RoundDifference::calculate($this->_combatreport, $startRound, $endRound);
		
	}
	
}