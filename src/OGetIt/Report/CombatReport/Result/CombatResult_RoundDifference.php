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
namespace OGetIt\Report\CombatReport\Result;

use OGetIt\Exception\Exception;
use OGetIt\Report\CombatReport\Fleet\Fleet;
use OGetIt\Common\Player;
use OGetIt\Report\CombatReport\CombatReport;
use OGetIt\Report\CombatReport\CombatPlayer;
use OGetIt\Report\CombatReport\CombatParty;

class CombatResult_RoundDifference {
	
	/**
	 * @var CombatParty[]
	 */
	private $attackers;

	/**
	 * @var CombatParty[]
	 */
	private $defenders;
	
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
		
		$self = new self();
		$self->setAttackers(self::getFleetDifferences($startAttackers, $endAttackers, clone $combatreport->getAttackerParty()));
		$self->setDefenders(self::getFleetDifferences($startDefenders, $endDefenders, clone $combatreport->getDefenderParty()));
		
		return $self;
		
	}
	
	/**
	 * @param CombatPlayer[] $start
	 * @param CombatPlayer[] $end
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
	
	/**
	 * @param CombatParty[] $attackers
	 */
	public function setAttackers($attackers) {
		
		$this->attackers = $attackers;
		
	}
	
	/**
	 * @return CombatParty[]
	 */
	public function getAttackers() {
		
		return $this->attackers;
		
	}
	
	/**
	 * @param CombatParty[] $defenders
	 */
	public function setDefenders($defenders) {
		
		$this->defenders = $defenders;
		
	}
	
	/**
	 * @return CombatParty[]
	 */
	public function getDefenders() {
		
		return $this->defenders;
		
	}
	
}