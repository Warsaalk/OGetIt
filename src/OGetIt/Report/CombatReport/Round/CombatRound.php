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
namespace OGetIt\Report\CombatReport\Round;

use OGetIt\Report\CombatReport\CombatParty;
use OGetIt\Report\CombatReport\Fleet\Fleet;
use OGetIt\Common\Player;
use OGetIt\Technology\TechnologyFactory;
use OGetIt\Report\CombatReport\CombatPlayer;

class CombatRound implements \JsonSerializable {
		
	/**
	 * @var integer
	 */
	private $number;
	
	/**
	 * @var CombatRound_Stats
	 */
	private $statistics;
	
	/** 
	 * @var CombatPlayer[]
	 */
	private $attacker_fleet_details;

	/**
	 * @var CombatPlayer[]
	 */
	private $defender_fleet_details;

	/**
	 * @param integer $number
	 * @param array $statistics
	 * @param array $attacker_ships
	 * @param array $attacker_ship_losses
	 * @param CombatParty $attacker_party
	 * @param array $defender_ships
	 * @param array $defender_ship_losses
	 * @param CombatParty $defender_party
	 */
	public function __construct($number, $statistics, $attacker_ships, $attacker_ship_losses, $attacker_party, $defender_ships, $defender_ship_losses, $defender_party) {
		
		$this->number = $number;
		
		$this->statistics = CombatRound_Stats::createInstance($statistics);

		$this->attacker_fleet_details = $this->loadFleetDetails($attacker_ships, $attacker_ship_losses, $attacker_party);
		$this->defender_fleet_details = $this->loadFleetDetails($defender_ships, $defender_ship_losses, $defender_party);
		
	}
	
	/**
	 * @param array $ships
	 * @param array $ship_losses
	 * @param CombatParty $party
	 * @return CombatPlayer[]
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
	 * @param CombatParty $party
	 * @return CombatPlayer[]
	 */
	private function createFleets($fleetDetails, $party) {
		
		$players = array();
		
		foreach ($party->getPlayers() as $player) {
						
			$clone = clone $player;
			
			foreach ($clone->getFleets() as $fleet) {
				
				if (isset($fleetDetails[$fleet->getCombatIndex()])) {
				
					$fleetData = $fleetDetails[$fleet->getCombatIndex()];
					
					foreach ($fleetData as $type => $techData) {
						
						$lost = isset($techData['lost']) ? $techData['lost'] : 0;
						$fleet->addTechnologyState(TechnologyFactory::create($type), $techData['ships'], $lost);
						
					}
				
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
		
		return $this->number;
		
	}
	
	/**
	 * @return CombatRound_Stats
	 */
	public function getStatistics() {
		
		return $this->statistics;
		
	}
	
	/**
	 * @return CombatPlayer[]
	 */
	public function getAttackersDetails() {
		
		return $this->attacker_fleet_details;
		
	}
	
	/**
	 * @return CombatPlayer[]
	 */
	public function getDefendersDetails() {
		
		return $this->defender_fleet_details;
		
	}
	
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize() {
		return array(
			'number' => $this->number,
			'statistics' => $this->statistics,
			'attacker_fleet_details' => $this->attacker_fleet_details,
			'defender_fleet_details' => $this->defender_fleet_details
		);
	}
		
}