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
namespace OGetIt\Report\CombatReport\Result;

use OGetIt\Exception\Exception;
use OGetIt\Report\CombatReport\Fleet\Fleet;
use OGetIt\Common\Player;
use OGetIt\Report\CombatReport\CombatReport;

class CombatResult_RoundDifference {
	
	/**
	 * @param CombatReport $combatreport
	 * @param integer $startRound
	 * @param integer $endRound
	 * @throws Exception
	 * @return CombatParty[]
	 */
	public static function calculate($combatreport, $startRound, $endRound) {
		
		//TODO:: Throw decent exeption
		if ($endRound < $startRound) throw new Exception('CombatReport_Result: Your starting round should be greater than your ending round.');
		if ($endRound > 6) throw new Exception('CombatReport_Result: OGame has a maximum of 6 rounds.');
		
		if ($startRound === 0) {
			$startAttackers = $combatreport->getAttackerParty()->getPlayers();
			$startDefenders = $combatreport->getDefenderParty()->getPlayers();
		} else {
			$startAttackers = $combatreport->getRound($startRound)->getAttackersDetails();
			$startDefenders = $combatreport->getRound($startRound)->getDefendersDetails();
		}
		
		if ($endRound === 0) {
			$endAttackers = $combatreport->getAttackerParty()->getPlayers();
			$endDefenders = $combatreport->getDefenderParty()->getPlayers();
		} else {
			$endAttackers = $combatreport->getRound($endRound)->getAttackersDetails();
			$endDefenders = $combatreport->getRound($endRound)->getDefendersDetails();
		}
		
		return array(
			'attackers' => self::getFleetDifferences($startAttackers, $endAttackers, clone $combatreport->getAttackerParty()),
			'defenders' => self::getFleetDifferences($startDefenders, $endDefenders, clone $combatreport->getDefenderParty())
		);
		
	}
	
	/**
	 * @param Player[] $start
	 * @param Player[] $end
	 * @param CombatParty $party
	 * @return CombatParty
	 */
	private static function getFleetDifferences($start, $end, $party) {
				
		foreach ($start as $i => $player) {
				
			$last = $end[$i];
			
			foreach ($player->getFleets() as $fleet) {

				$combatIndex = $fleet->getCombatIndex();
				$partyPlayer = $party->getPlayerByCombatIndex($combatIndex);
				
				$partyPlayer->updateFleet($fleet->difference($last->getFleetByCombatIndex($combatIndex)));
		
			}
				
		}
		
		return $party;
		
	}
	
}