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
	
	/**
	 * @return OGetIt_CombatParty[]
	 */
	public function getFinalResult() {
		
		return $this->getRoundDifference(0, $this->_combatreport->getRoundCount());
		
	}
	
}