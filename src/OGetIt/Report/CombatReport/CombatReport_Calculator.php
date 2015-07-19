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
namespace OGetIt\Report\CombatReport;

use OGetIt\Exception\Exception;
use OGetIt\Report\CombatReport\Fleet\Fleet;
use OGetIt\Common\Player;
use OGetIt\Report\CombatReport\Result\CombatResult_RoundDifference;

class CombatReport_Calculator {
	
	/**
	 * @var CombatReport
	 */
	private $_combatreport;
	
	/**
	 * @param CombatReport $combatreport
	 */
	public function __construct(CombatReport $combatreport) {
		
		$this->_combatreport = $combatreport;
		
	}
	
	/**
	 * @param integer $startRound Round number, if 0 it'll use the initial fleet state
	 * @param integer $endRound
	 * @throws Exception
	 * @return CombatParty[]
	 */
	public function getRoundDifference($startRound, $endRound) {
		
		return CombatResult_RoundDifference::calculate($this->_combatreport, $startRound, $endRound);
		
	}
	
	/**
	 * @return CombatParty[]
	 */
	public function getFinalResult() {
		
		return $this->getRoundDifference(0, $this->_combatreport->getRoundCount());
		
	}
	
}