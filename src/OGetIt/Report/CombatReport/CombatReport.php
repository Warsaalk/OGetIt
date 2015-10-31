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

use OGetIt\Common\Planet;
use OGetIt\Common\Player;
use OGetIt\Common\Alliance;
use OGetIt\Report\CombatReport\Fleet\Fleet;
use OGetIt\Technology\TechnologyFactory;
use OGetIt\Report\CombatReport\Round\CombatRound;
use OGetIt\Common\Resources;
use OGetIt\Common\DebrisField;
use OGetIt\Report\Report;
use OGetIt\Report\CombatReport\Fleet\CombatFleet;

class CombatReport extends Report {
	
	const 	WINNER_ATTACKER = 'attacker',
			WINNER_DEFENDER = 'defender',
			WINNER_DRAW = 'draw';
	
	/**
	 * @var Planet
	 */
	private $planet;
	
	/**
	 * @var integer
	 */
	private $loot_percentage;
	
	/**
	 * @var integer
	 */
	private $combat_rounds_count;
	
	/**
	 * @var boolean
	 */
	private $combat_honourable;
	
	/**
	 * @var Resources
	 */
	private $loot;

	/**
	 * @var DebrisField
	 */
	private $debris_field;
	
	/**
	 * @var string
	 */
	private $winner;
	
	/**
	 * @var CombatParty
	 */
	private $attacker_party;

	/**
	 * @var CombatParty
	 */
	private $defender_party;
	
	/**
	 * @var CombatRound[]
	 */
	private $combat_rounds;
	
	/**
	 * @var CombatReport[]
	 */
	private $raids = array();
	
	/**
	 * @var CombatReport_Calculator
	 */
	private $combatreport_calculator;
	
	/**
	 * @var integer
	 */
	private $player_id_count = 0;
	
	/**
	 * @var CombatMoon
	 */
	private $combat_moon;
	
	/**
	 * @param string $api_data
	 * @return CombatReport
	 */
	public static function createCombatReport($api_data) {
				
		$generic = $api_data['generic'];
		
		$combatreport = new self(
			$generic['cr_id'], 
			$generic['combat_coordinates'], 
			$generic['combat_planet_type'],
			$generic['combat_rounds'],
			$generic['combat_honorable'],
			$generic['event_time'],
			$generic['event_timestamp'],
			$generic['loot_percentage'],
			$generic['winner'],
			$generic['units_lost_attackers'],
			$generic['attacker_count'],
			$generic['attacker_honorable'],
			$generic['attacker_honorpoints'],
			$generic['units_lost_defenders'],
			$generic['defender_count'],
			$generic['defender_honorable'],
			$generic['defender_honorpoints'],
			$generic['loot_metal'],
			$generic['loot_crystal'],
			$generic['loot_deuterium'],
			$generic['debris_metal'],
			$generic['debris_crystal'],
			$generic['moon_chance'],
			$generic['moon_created'],
			$generic['moon_exists'],
			$generic['moon_size']
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
	 * @param boolean $attacker_honorable
	 * @param integer $attacker_honorpoints
	 * @param integer $defender_losses
	 * @param integer $defender_count
	 * @param boolean $defender_honorable
	 * @param integer $defender_honorpoints
	 * @param integer $loot_metal
	 * @param integer $loot_crystal
	 * @param integer $loot_deuterium
	 * @param integer $debris_metal
	 * @param integer $debris_crystal
	 */
	public function __construct($id, $coordinates, $planet_type, $combat_rounds, $combat_honourable, $time, $timestamp, $loot_percentage, $winner, $attacker_losses, $attacker_count, $attacker_honourable, $attacker_honourpoints, $defender_losses, $defender_count, $defender_honourable, $defender_honourpoints, $loot_metal, $loot_crystal, $loot_deuterium, $debris_metal, $debris_crystal, $moon_chance, $moon_created, $moon_exists, $moon_size) {
		
		parent::__construct($id, $time, $timestamp);
		
		$this->loot_percentage = $loot_percentage;
		$this->combat_rounds_count = $combat_rounds;
		$this->combat_honourable = $combat_honourable;
		$this->winner = $winner;
		$this->planet = new Planet($planet_type, $coordinates);
		
		$this->attacker_party = new CombatParty($attacker_count, $attacker_losses, $attacker_honourable, $attacker_honourpoints);
		$this->defender_party = new CombatParty($defender_count, $defender_losses, $defender_honourable, $defender_honourpoints);
		
		$this->loot = new Resources($loot_metal, $loot_crystal, $loot_deuterium);
		$this->debris_field = new DebrisField($coordinates, $debris_metal, $debris_crystal);
		
		$this->combatreport_calculator = new CombatReport_Calculator($this);
		
		$this->combat_moon = new CombatMoon($moon_chance, $moon_created, $moon_exists, $moon_size);
		
	}
	
	/**
	 * @param array $attackers
	 */
	private function loadAttackers($attackers) {
		
		$players = $this->loadParty($attackers);
		
		$this->attacker_party->setPlayers($players);
		
	}
	
	/**
	 * @param array $defenders
	 */
	private function loadDefenders($defenders) {
		
		$players = $this->loadParty($defenders);
		
		$this->defender_party->setPlayers($players);
		
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
				$playerId = $this->player_id_count++;
				$playerIdMapping[$rawPlayer] = $playerId;
				$players[$playerId] = new CombatPlayer($rawPlayer, $playerId);
				$players[$playerId]->setCombatTechnologies(
					$fleetData['fleet_armor_percentage'], 
					$fleetData['fleet_shield_percentage'], 
					$fleetData['fleet_weapon_percentage']
				);
				$players[$playerId]->setAlliance(new Alliance($fleetData['fleet_owner_alliance_tag'], $fleetData['fleet_owner_alliance']));
			}
			
			$player = $players[$playerId];
			$planet = new Planet(
				$fleetData['fleet_owner_planet_type'], 
				$fleetData['fleet_owner_coordinates'], 
				$fleetData['fleet_owner_planet_name']
			);
			$fleet = new CombatFleet($planet, $combat_index);
			
			foreach ($fleetData['fleet_composition'] as $rawTechnology) {
				
				$technology = TechnologyFactory::create($rawTechnology['ship_type']);
				
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
			
			$this->combat_rounds[$rawRound['round_number']] = new CombatRound(
				$rawRound['round_number'], 
				$rawRound['statistics'],
				$rawRound['attacker_ships'],
				$rawRound['attacker_ship_losses'],
				$this->attacker_party,
				$rawRound['defender_ships'],
				$rawRound['defender_ship_losses'],
				$this->defender_party
			);
			
		}		
		
	}
	
	/**
	 * @return Planet
	 */
	public function getPlanet() {
		
		return $this->planet;
		
	}
	
	/**
	 * @return boolean
	 */
	public function isCombatHonourable() {
		
		return $this->combat_honourable;
		
	}
	
	/**
	 * @return string
	 */
	public function getWinner() {
		
		return $this->winner;
		
	}
	
	/**
	 * @return string
	 */
	public function getLootPercentage() {
		
		return $this->loot_percentage;
		
	}
	
	/**
	 * @return Resources
	 */
	public function getLoot() {
		
		return $this->loot;
		
	}
	
	/**
	 * @return DebrisField
	 */
	public function getDebrisField() {
		
		return $this->debris_field;
		
	}

	/**
	 * @return CombatParty
	 */
	public function getAttackerParty() {
		
		return $this->attacker_party;
		
	}
	
	/**
	 * @return CombatParty
	 */
	public function getDefenderParty() {
		
		return $this->defender_party;
		
	}
	
	/**
	 * @return integer
	 */
	public function getRoundCount() {
		
		return $this->combat_rounds_count;
		
	}
	
	/**
	 * @return CombatRound[]
	 */
	public function getRounds() {
		
		return $this->combat_rounds;
		
	}
	
	/**
	 * @param integer $number
	 * @return CombatRound|null
	 */
	public function getRound($number) {
		
		return isset($this->combat_rounds[$number]) ? $this->combat_rounds[$number] : null;
		
	}
	
	/**
	 * @param CombatReport $raid
	 * @return boolean
	 */
	public function addRaid(CombatReport $raid) {
		
		if ($raid->getPlanet()->getCoordinates() !== $this->getPlanet()->getCoordinates()) return false;
		
		$this->raids[] = $raid;
		
		return true;
		
	}
	
	/**
	 * @return CombatReport[]
	 */
	public function getRaids() {
		
		return $this->raids;
		
	}
	
	/**
	 * @return boolean
	 */
	public function hasRaids() {
		
		return !empty($this->raids);
		
	}
	
	/**
	 * @return CombatReport_Calculator
	 */
	public function getCalculator() {
		
		return $this->combatreport_calculator;
		
	}
	
	/**
	 * @return CombatMoon
	 */
	public function getCombatMoon() {
		
		return $this->combat_moon;
		
	}
	
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize() {
		return array_merge(array(
			'planet' => $this->planet,
			'loot_percentage' => $this->loot_percentage,
			'combat_rounds_count' => $this->combat_rounds_count,
			'combat_honourable' => $this->combat_honourable,
			'loot' => $this->loot,
			'debris_field' => $this->debris_field,
			'winner' => $this->winner,
			'attacker_party' => $this->attacker_party,
			'defender_party' => $this->defender_party,
			'combat_rounds' => $this->combat_rounds,
			'raids' => $this->raids,
			'player_id_count' => $this->player_id_count,
			'combat_moon' => $this->combat_moon,
		), parent::jsonSerialize());
	}
	
}