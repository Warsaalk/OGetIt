<?php

namespace OGetIt\CombatReport;

use OGetIt\Common\OGetIt_Planet;
use OGetIt\Common\OGetIt_Player;
use OGetIt\Common\OGetIt_Fleet;
use OGetIt\Technology\OGetIt_Technology_Factory;
use OGetIt\CombatReport\Round\OGetIt_CombatRound;

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
	 * @var \stdClass
	 */
	private $_loot;

	/**
	 * @var \stdClass
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
	 * @var OGetIt_CombatRound
	 */
	private $_combat_rounds;
	
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
		
		$this->_loot = new \stdClass();
		$this->_loot->metal = $loot_metal;
		$this->_loot->crystal = $loot_crystal;
		$this->_loot->deuterium = $loot_deuterium;
		
		$this->_debris = new \stdClass();
		$this->_debris->metal = $debris_metal;
		$this->_debris->crystal = $debris_crystal;
		
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
		
		$players = array();
		
		foreach ($rawPlayers as $combat_index => $fleetData) {
			
			$rawPlayer = $fleetData['fleet_owner'];
			
			//Check if player already exists, if not create it & add it
			if (!isset($players[$rawPlayer])) {
				$players[$rawPlayer] = new OGetIt_Player($rawPlayer);
				$players[$rawPlayer]->setCombatTechnologies(
					$fleetData['fleet_armor_percentage'], 
					$fleetData['fleet_shield_percentage'], 
					$fleetData['fleet_weapon_percentage']
				);
			}
			
			$player = $players[$rawPlayer];
			$planet = new OGetIt_Planet(
				$fleetData['fleet_owner_planet_type'], 
				$fleetData['fleet_owner_coordinates'], 
				$fleetData['fleet_owner_planet_name']
			);
			$fleet = new OGetIt_Fleet($planet, $combat_index);
			
			foreach ($fleetData['fleet_composition'] as $rawTechnology) {
				
				$technology = OGetIt_Technology_Factory::create($rawTechnology['ship_type']);
				
				$fleet->addTechnology($technology, $rawTechnology['count']);
				
			}
			
			$player->addFleet($fleet);
			
		}
		
		return array_values($players);
		
	}
	
	/**
	 * @param array $rawRounds
	 */
	private function loadRounds($rawRounds) {
		
		foreach ($rawRounds as $rawRound) {
			
			$this->_combat_rounds[] = new OGetIt_CombatRound(
				$rawRound['round_number'], 
				$rawRound['statistics'],
				$rawRound['attacker_ships'],
				$rawRound['attacker_ship_losses'],
				$rawRound['defender_ships'],
				$rawRound['defender_ship_losses']
			);
			
		}		
		
	}
	
}