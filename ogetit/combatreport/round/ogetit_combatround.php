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
namespace OGetIt\CombatReport\Round;

use OGetIt\CombatReport\OGetIt_CombatParty;
use OGetIt\CombatReport\Fleet\OGetIt_Fleet;
use OGetIt\Common\OGetIt_Player;
use OGetIt\Technology\OGetIt_Technology_Factory;

class OGetIt_CombatRound {
		
	/**
	 * @var integer
	 */
	private $_number;
	
	/**
	 * @var OGetIt_CombatRound_Stats
	 */
	private $_statistics;
	
	/** 
	 * @var OGetIt_Player[]
	 */
	private $_attacker_fleet_details;

	/**
	 * @var OGetIt_Player[]
	 */
	private $_defender_fleet_details;

	/**
	 * @param integer $number
	 * @param array $statistics
	 * @param array $attacker_ships
	 * @param array $attacker_ship_losses
	 * @param OGetIt_CombatParty $attacker_party
	 * @param array $defender_ships
	 * @param array $defender_ship_losses
	 * @param OGetIt_CombatParty $defender_party
	 */
	public function __construct($number, $statistics, $attacker_ships, $attacker_ship_losses, $attacker_party, $defender_ships, $defender_ship_losses, $defender_party) {
		
		$this->_number = $number;
		
		$this->_statistics = OGetIt_CombatRound_Stats::createInstance($statistics);

		$this->_attacker_fleet_details = $this->loadFleetDetails($attacker_ships, $attacker_ship_losses, $attacker_party);
		$this->_defender_fleet_details = $this->loadFleetDetails($defender_ships, $defender_ship_losses, $defender_party);
		
	}
	
	/**
	 * @param array $ships
	 * @param array $ship_losses
	 * @param OGetIt_CombatParty $party
	 * @return OGetIt_Player[]
	 */
	private function loadFleetDetails($ships, $ship_losses, $party) {
		
		$details = array();
		
		foreach ($ships as $data) {
			
			$combat_index = $data['owner'];
			
			if (!isset($details[$combat_index])) $details[$combat_index] = array();
			
			$details[$combat_index][$data['ship_type']] = array(
				'ships' => $data['count']
			);
			
		}
		
		foreach ($ship_losses as $data) {
												
			$details[$data['owner']][$data['ship_type']]['lost'] = (int)$data['count'];
				
		}
		
		return $this->createFleets($details, $party);
		
	}
	
	/**
	 * @param array $fleetDetails
	 * @param OGetIt_CombatParty $party
	 * @return OGetIt_Player[]
	 */
	private function createFleets($fleetDetails, $party) {
		
		$players = array();
		
		foreach ($party->getPlayers() as $player) {
						
			$clone = clone $player;
			
			foreach ($clone->getFleets() as $fleet) {
				
				$fleetData = $fleetDetails[$fleet->getCombatIndex()];
				
				foreach ($fleetData as $type => $techData) {
					
					$lost = isset($techData['lost']) ? $techData['lost'] : 0;
					$fleet->addTechnologyState(OGetIt_Technology_Factory::create($type), $techData['ships'], $lost);
					
				}
				
				
			}
			
			$players[$player->getId()] = $clone;
			
		}
		
		return $players;
		
	}
	
	/**
	 * @return integer
	 */
	public function getNumber() {
		
		return $this->_number;
		
	}
	
	/**
	 * @return OGetIt_CombatRound_Stats
	 */
	public function getStatistics() {
		
		return $this->_statistics;
		
	}
	
	/**
	 * @param integer $combat_index
	 * @param integer $ship_type
	 * @return array
	 */
	public function getAttackerShipsDetails($combat_index, $ship_type) {
		
		return isset($this->_attacker_fleet_details[$combat_index][$ship_type]) ? $this->_attacker_fleet_details[$combat_index][$ship_type] : null;
		
	}
	
	/**
	 * @param integer $combat_index
	 * @return array
	 */
	public function getAttackerFleetDetails($combat_index) {
		
		return isset($this->_attacker_fleet_details[$combat_index]) ? $this->_attacker_fleet_details[$combat_index] : null;
		
	}
	
	/**
	 * @return OGetIt_Player[]
	 */
	public function getAttackersDetails() {
		
		return $this->_attacker_fleet_details;
		
	}
	
	/**
	 * @param integer $combat_index
	 * @param integer $ship_type
	 * @return array
	 */
	public function getDefenderShipsDetails($combat_index, $ship_type) {
		
		return isset($this->_defender_fleet_details[$combat_index][$ship_type]) ? $this->_defender_fleet_details[$combat_index][$ship_type] : null;
		
	}
	
	/**
	 * @param integer $combat_index
	 * @return array
	 */
	public function getDefenderFleetDetails($combat_index) {
		
		return isset($this->_defender_fleet_details[$combat_index]) ? $this->_defender_fleet_details[$combat_index] : null;
				
	}
	
	/**
	 * @return OGetIt_Player[]
	 */
	public function getDefendersDetails() {
		
		return $this->_defender_fleet_details;
		
	}
		
}