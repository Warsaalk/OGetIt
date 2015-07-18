<?php
namespace OGetIt\SpyReport;

use OGetIt\Common\Resources;
use OGetIt\Common\Player;
use OGetIt\Common\Planet;

class SpyReport {

	/**
	 * @var string
	 */
	private $_id;
	
	/**
	 * @var integer
	 */
	private $_activity;
	
	/**
	 * @var Player
	 */
	private $_attacker;
	
	/**
	 * @var Planet
	 */
	private $_attacker_planet;

	/**
	 * @var Player
	 */
	private $_defender;

	/**
	 * @var Planet
	 */
	private $_defender_planet;
	
	/**
	 * @var string
	 */
	private $_time;
	
	/**
	 * @var integer
	 */
	private $_timestamp;

	/**
	 * @var integer
	 */
	private $_loot_percentage;

	/**
	 * @var integer
	 */
	private $_spy_fail_chance;

	/**
	 * @var integer
	 */
	private $_total_defense_count;

	/**
	 * @var integer
	 */
	private $_total_ship_count;
	
	/**
	 * @param string $api_data
	 * @return CombatReport
	 */
	public static function createSpyReport($api_data) {
	
		$generic = $api_data['generic'];
	
		$spyreport = new self(
			$generic['sr_id'],
			$generic['activity'],
			$generic['attacker_name'],
			$generic['attacker_planet_coordinates'],
			$generic['attacker_planet_name'],
			$generic['attacker_planet_type'],
			$generic['defender_name'],
			$generic['defender_planet_coordinates'],
			$generic['defender_planet_name'],
			$generic['defender_planet_type'],
			$generic['event_time'],
			$generic['event_timestamp'],
			$generic['loot_percentage'],
			$generic['spy_fail_chance'],
			$generic['total_defense_count'],
			$generic['total_ship_count']				
		);
						
		if ($generic['failed_buildings']) {
			
		}

		if ($generic['failed_research']) {
			
		}
		
		if ($generic['failed_ships']) {
			
		}
		
		if ($generic['failed_defense']) {
			
		}
			
		return $spyreport;
	
	}
	
	/**
	 * @param string $id
	 * @param integer $activity
	 * @param string $attacker_name
	 * @param string $attacker_planet_coordinates
	 * @param string $attacker_planet_name
	 * @param integer $attacker_planet_type
	 * @param string $defender_name
	 * @param string $defender_planet_coordinates
	 * @param string $defender_planet_name
	 * @param integer $defender_planet_type
	 * @param string $event_time
	 * @param integer $event_timestamp
	 * @param integer $loot_percentage
	 * @param integer $spy_fail_chance
	 * @param integer $total_defense_count
	 * @param integer $total_ship_count
	 */
	public function __construct($id, $activity, $attacker_name, $attacker_planet_coordinates, $attacker_planet_name, $attacker_planet_type, $defender_name, $defender_planet_coordinates, $defender_planet_name, $defender_planet_type, $time, $timestamp, $loot_percentage, $spy_fail_chance, $total_defense_count, $total_ship_count) {
		
		$this->_id = $id;
		$this->_activity = $activity;
		
		$this->_attacker = new Player($attacker_name);
		$this->_attacker_planet = new Planet($attacker_planet_type, $attacker_planet_coordinates, $attacker_planet_name);
		
		$this->_defender = new Player($defender_name);
		$this->_defender_planet = new Planet($defender_planet_type, $defender_planet_coordinates, $defender_planet_name);
		
		$this->_time = $time;
		$this->_timestamp = $timestamp;
		
		$this->_loot_percentage = $loot_percentage;
		$this->_spy_fail_chance = $spy_fail_chance;
		$this->_total_defense_count = $total_defense_count;
		$this->_total_ship_count = $total_ship_count;
		
	}
	
	/**
	 * @return string
	 */
	public function getId() {
		
		return $this->_id;
		
	}
	
	/**
	 * @return integer
	 */
	public function getActivity() {
		
		return $this->_activity;
		
	}
	
	/**
	 * @return Player
	 */
	public function getAttacker() {
		
		return $this->_attacker;
		
	}
	
	/**
	 * @return Planet
	 */
	public function getAttackerPlanet() {
		
		return $this->_attacker_planet;
		
	}
	
	/**
	 * @return Player
	 */
	public function getDefender() {
		
		return $this->_defender;
		
	}
	
	/**
	 * @return Planet
	 */
	public function getDefenderPlanet() {
		
		return $this->_defender_planet;
		
	}
	
	/**
	 * @return string
	 */
	public function getTime() {
		
		return $this->_time;
		
	}
	
	/**
	 * @return integer
	 */
	public function getTimestamp() {
		
		return $this->_timestamp;
		
	}

	/**
	 * @return integer
	 */
	public function getLootPercentage() {
		
		return $this->_loot_percentage;
		
	}
	
	/**
	 * @return integer
	 */
	public function getSpyFailChance() {
		
		return $this->_spy_fail_chance;
		
	}
	
	/**
	 * @return integer
	 */
	public function getTotalDefenseCount() {
		
		return $this->_total_defense_count;
		
	}
	
	/**
	 * @return integer
	 */
	public function getTotalShipCount() {
		
		return $this->_total_ship_count;
		
	}
	
}