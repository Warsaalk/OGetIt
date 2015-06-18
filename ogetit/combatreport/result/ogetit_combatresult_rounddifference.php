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
namespace OGetIt\CombatReport\Result;

use OGetIt\Exception\OGetIt_Exception;
use OGetIt\CombatReport\Fleet\OGetIt_Fleet;
use OGetIt\Common\OGetIt_Player;
use OGetIt\CombatReport\OGetIt_CombatReport;

class OGetIt_CombatResult_RoundDifference {
	
	/**
	 * @param OGetIt_CombatReport $combatreport
	 * @param integer $startRound
	 * @param integer $endRound
	 * @throws OGetIt_Exception
	 * @return OGetIt_CombatParty[]
	 */
	public static function calculate($combatreport, $startRound, $endRound) {
		
		//TODO:: Throw decent exeption
		if ($endRound <= $startRound) throw new OGetIt_Exception('OGetIt_CombatReport_Result: Your starting round should be greater than your ending round.');
		if ($endRound > 6) throw new OGetIt_Exception('OGetIt_CombatReport_Result: OGame has a maximum of 6 rounds.');
		
		if ($startRound === 0) {
			$startAttackers = $combatreport->getAttackerParty()->getPlayers();
			$startDefenders = $combatreport->getDefenderParty()->getPlayers();
		} else {
			$startAttackers = $combatreport->getRound($startRound)->getAttackersDetails();
			$startDefenders = $combatreport->getRound($startRound)->getDefendersDetails();
		}
		
		$endAttackers = $combatreport->getRound($endRound)->getAttackersDetails();
		$endDefenders = $combatreport->getRound($endRound)->getDefendersDetails();
		
		return array(
			'attackers' => self::getFleetDifferences($startAttackers, $endAttackers, clone $combatreport->getAttackerParty()),
			'defenders' => self::getFleetDifferences($startDefenders, $endDefenders, clone $combatreport->getDefenderParty())
		);
		
	}
	
	/**
	 * @param OGetIt_Player[] $start
	 * @param OGetIt_Player[] $end
	 * @param OGetIt_CombatParty $party
	 * @return OGetIt_CombatParty
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