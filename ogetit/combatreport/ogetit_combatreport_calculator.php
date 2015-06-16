<?php
namespace OGetIt\CombatReport;

class OGetIt_CombatReport_Calculator {
	
	/**
	 * @var OGetIt_CombatReport
	 */
	private $_combatreport;
	
	/**
	 * @param OGetIt_CombatReport $combatreport
	 */
	public function __construct($combatreport) {
		
		$this->_combatreport = $combatreport;
		
	}
	
	/**
	 * @param integer $startRound Round number, if 0 it'll use the initial fleet state
	 * @param integer $endRound
	 * @throws OGetIt_Exception
	 */
	public function getRoundDifference($startRound, $endRound) {
		
		//TODO:: Throw decent exeption
		if ($endRound <= $startRound) throw new OGetIt_Exception('OGetIt_CombatReport_Result: Your starting round should be greater than your ending round.');
		if ($endRound > 6) throw new OGetIt_Exception('OGetIt_CombatReport_Result: OGame has a maximum of 6 rounds.');
		
		if ($startRound === 0) {
			$startAttackers = $this->_combatreport->getAttackerParty()->getPlayers();
			$startDefenders = $this->_combatreport->getDefenderParty()->getPlayers();
		} else {
			$startAttackers = $this->_combatreport->getRound($startRound)->getAttackersDetails();
			$startDefenders = $this->_combatreport->getRound($startRound)->getDefendersDetails();
		}
		
		$endAttackers = $this->_combatreport->getRound($endRound)->getAttackersDetails();
		$endDefenders = $this->_combatreport->getRound($endRound)->getDefendersDetails();
		
		
		
	}
	
}