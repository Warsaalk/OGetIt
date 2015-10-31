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
namespace OGetIt\Report\CombatReport;

use OGetIt\Exception\Exception;
use OGetIt\Report\CombatReport\Fleet\Fleet;
use OGetIt\Report\CombatReport\Result\CombatResult_RoundDifference;

class CombatReport_Calculator {
	
	/**
	 * @var CombatReport
	 */
	private $combatreport;
	
	/**
	 * @param CombatReport $combatreport
	 */
	public function __construct(CombatReport $combatreport) {
		
		$this->combatreport = $combatreport;
		
	}
	
	/**
	 * @param integer $startRound Round number, if 0 it'll use the initial fleet state
	 * @param integer $endRound
	 * @throws Exception
	 * @return CombatResult_RoundDifference
	 */
	public function getRoundDifference($startRound, $endRound) {
		
		return CombatResult_RoundDifference::calculate($this->combatreport, $startRound, $endRound);
		
	}
	
	/**
	 * @return CombatResult_RoundDifference
	 */
	public function getFinalResult() {
		
		return $this->getRoundDifference(0, $this->combatreport->getRoundCount());
		
	}
	
}