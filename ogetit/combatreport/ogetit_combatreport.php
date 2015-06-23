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

use OGetIt\Common\OGetIt_Planet;
use OGetIt\Common\OGetIt_Player;
use OGetIt\CombatReport\Fleet\OGetIt_Fleet;
use OGetIt\Technology\OGetIt_Technology_Factory;
use OGetIt\CombatReport\Round\OGetIt_CombatRound;
use OGetIt\Common\OGetIt_Resources;
use OGetIt\Common\OGetIt\Common;

class OGetIt_CombatReport {
	
	const 	WINNER_ATTACKER = 'attacker',
			WINNER_DEFENDER = 'defender',
			WINNER_DRAW = 'draw';
	
	/**
	 * @var string
	 */
	private $_id;
	
	/**
	 * @var OGetIt_Planet
	 */
	private $_planet;
	
	/**
	 * @var integer
	 */
	private $_loot_percentage;
	
	/**
	 * @var integer
	 */
	private $_combat_rounds_count;
	
	/**
	 * @var OGetIt_Resources
	 */
	private $_loot;

	/**
	 * @var OGetIt_Resources
	 */
	private $_debris;
	
	/**
	 * @var string
	 */
	private $_winner;
	
	/**
	 * @var OGetIt_CombatParty
	 */
	private $_attacker_party;

	/**
	 * @var OGetIt_CombatParty
	 */
	private $_defender_party;
	
	/**
	 * @var OGetIt_CombatRound[]
	 */
	private $_combat_rounds;
	
	/**
	 * @var OGetIt_CombatReport[]
	 */
	private $_raids;
	
	/**
	 * @var OGetIt_CombatReport_Calculator
	 */
	private $_combatreport_calculator;
	
	/**
	 * @var integer
	 */
	private $_player_id_count = 0;
	
	/**
	 * @param string $api_data
	 * @return OGetIt_CombatReport
	 */
	public static function createCombatReport($api_data) {
				
		$generic = $api_data['generic'];
		
		$combatreport = new self(
			$generic['cr_id'], 
			$generic['combat_coordinates'], 
			$generic['combat_planet_type'],
			$generic['combat_rounds'],
			$generic['loot_percentage'],
			$generic['winner'],
			$generic['units_lost_attackers'],
			$generic['attacker_count'],
			$generic['units_lost_defenders'],
			$generic['defender_count'],
			$generic['loot_metal'],
			$generic['loot_crystal'],
			$generic['loot_deuterium'],
			$generic['debris_metal'],
			$generic['debris_crystal']
		);

		$attackers = $api_data['attackers'];
		
		$combatreport->loadAttackers($attackers);
		
		$defenders = $api_data['defenders'];
		
		$combatreport->loadDefenders($defenders);
		
		$rounds = $api_data['rounds'];
		
		$combatreport->loadRounds($rounds);
		
		return $combatreport;
		
	}
	
	/**
	 * @param string $id
	 * @param string $coordinates
	 * @param integer $planet_type
	 * @param integer $combat_rounds
	 * @param integer $loot_percentage
	 * @param string $winner
	 * @param integer $attacker_losses
	 * @param integer $attacker_count
	 * @param integer $defender_losses
	 * @param integer $defender_count
	 * @param integer $loot_metal
	 * @param integer $loot_crystal
	 * @param integer $loot_deuterium
	 * @param integer $debris_metal
	 * @param integer $debris_crystal
	 */
	public function __construct($id, $coordinates, $planet_type, $combat_rounds, $loot_percentage, $winner, $attacker_losses, $attacker_count, $defender_losses, $defender_count, $loot_metal, $loot_crystal, $loot_deuterium, $debris_metal, $debris_crystal) {
		
		$this->_id = $id;
		$this->_loot_percentage = $loot_percentage;
		$this->_combat_rounds_count = $combat_rounds;
		$this->_winner = $winner;
		$this->_planet = new OGetIt_Planet($planet_type, $coordinates);
		
		$this->_attacker_party = new OGetIt_CombatParty($attacker_count, $attacker_losses);
		$this->_defender_party = new OGetIt_CombatParty($defender_count, $defender_losses);
		
		$this->_loot = new OGetIt_Resources($loot_metal, $loot_crystal, $loot_deuterium);
		$this->_debris = new OGetIt_Resources($debris_metal, $debris_crystal, 0);
		
		$this->_combatreport_calculator = new OGetIt_CombatReport_Calculator($this);
		
	}
	
	/**
	 * @param array $attackers
	 */
	private function loadAttackers($attackers) {
		
		$players = $this->loadParty($attackers);
		
		$this->_attacker_party->setPlayers($players);
		
	}
	
	/**
	 * @param array $defenders
	 */
	private function loadDefenders($defenders) {
		
		$players = $this->loadParty($defenders);
		
		$this->_defender_party->setPlayers($players);
		
	}
	
	/**
	 * @param array $rawPlayers
	 */
	private function loadParty($rawPlayers) {
		
		$playerIdMapping = array();
		$players = array();
		
		foreach ($rawPlayers as $combat_index => $fleetData) {
			
			$rawPlayer = $fleetData['fleet_owner'];
			$playerId = isset($playerIdMapping[$rawPlayer]) ? $playerIdMapping[$rawPlayer] : false;

			//Check if player already exists, if not create it & add it
			if ($playerId === false) {
				$playerId = $this->_player_id_count++;
				$playerIdMapping[$rawPlayer] = $playerId;
				$players[$playerId] = new OGetIt_Player($rawPlayer, $playerId);
				$players[$playerId]->setCombatTechnologies(
					$fleetData['fleet_armor_percentage'], 
					$fleetData['fleet_shield_percentage'], 
					$fleetData['fleet_weapon_percentage']
				);
			}
			
			$player = $players[$playerId];
			$planet = new OGetIt_Planet(
				$fleetData['fleet_owner_planet_type'], 
				$fleetData['fleet_owner_coordinates'], 
				$fleetData['fleet_owner_planet_name']
			);
			$fleet = new OGetIt_Fleet($planet, $combat_index);
			
			foreach ($fleetData['fleet_composition'] as $rawTechnology) {
				
				$technology = OGetIt_Technology_Factory::create($rawTechnology['ship_type']);
				
				$fleet->addTechnologyState($technology, $rawTechnology['count']);
				
			}
			
			$player->addFleet($fleet);
			
		}
		
		return $players;
		
	}
	
	/**
	 * @param array $rawRounds
	 */
	private function loadRounds($rawRounds) {
		
		foreach ($rawRounds as $rawRound) {
			
			$this->_combat_rounds[$rawRound['round_number']] = new OGetIt_CombatRound(
				$rawRound['round_number'], 
				$rawRound['statistics'],
				$rawRound['attacker_ships'],
				$rawRound['attacker_ship_losses'],
				$this->_attacker_party,
				$rawRound['defender_ships'],
				$rawRound['defender_ship_losses'],
				$this->_defender_party
			);
			
		}		
		
	}
	
	/**
	 * @return OGetIt_Planet
	 */
	public function getPlanet() {
		
		return $this->_planet;
		
	}
	
	/**
	 * @return string
	 */
	public function getWinner() {
		
		return $this->_winner;
		
	}
	
	/**
	 * @return string
	 */
	public function getLootPercentage() {
		
		return $this->_loot_percentage;
		
	}
	
	/**
	 * @return OGetIt_Resources
	 */
	public function getLoot() {
		
		return $this->_loot;
		
	}
	
	/**
	 * @return OGetIt_Resources
	 */
	public function getDebris() {
		
		return $this->_debris;
		
	}

	/**
	 * @return OGetIt_CombatParty
	 */
	public function getAttackerParty() {
		
		return $this->_attacker_party;
		
	}
	
	/**
	 * @return OGetIt_CombatParty
	 */
	public function getDefenderParty() {
		
		return $this->_defender_party;
		
	}
	
	/**
	 * @return integer
	 */
	public function getRoundCount() {
		
		return $this->_combat_rounds_count;
		
	}
	
	/**
	 * @return OGetIt_CombatRound[]
	 */
	public function getRounds() {
		
		return $this->_combat_rounds;
		
	}
	
	/**
	 * @param integer $number
	 * @return OGetIt_CombatRound|null
	 */
	public function getRound($number) {
		
		return isset($this->_combat_rounds[$number]) ? $this->_combat_rounds[$number] : null;
		
	}
	
	/**
	 * TODO:: Check if the coordinates are the same
	 * @param OGetIt_CombatReport $raid
	 */
	public function addRaid(OGetIt_CombatReport $raid) {
		
		$this->_raids[] = $raid;
		
	}
	
	/**
	 * @return OGetIt_CombatReport[]
	 */
	public function getRaids() {
		
		return $this->_raids;
		
	}
	
	/**
	 * @return boolean
	 */
	public function hasRaids() {
		
		return !empty($this->_raids);
		
	}
	
	/**
	 * @return OGetIt_CombatReport_Calculator
	 */
	public function getCalculator() {
		
		return $this->_combatreport_calculator;
		
	}
	
}