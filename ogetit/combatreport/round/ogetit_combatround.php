<?php

namespace OGetIt\CombatReport\Round;

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
	 * @var array
	 */
	private $_attacker_fleet_details;

	/**
	 * @var array
	 */
	private $_defender_fleet_details;

	/**
	 * @param integer $number
	 * @param array $statistics
	 * @param array $attacker_ships
	 * @param array $attacker_ship_losses
	 * @param array $defender_ships
	 * @param array $defender_ship_losses
	 */
	public function __construct($number, $statistics, $attacker_ships, $attacker_ship_losses, $defender_ships, $defender_ship_losses) {
		
		$this->_number = $number;
		
		$this->_statistics = OGetIt_CombatRound_Stats::createInstance($statistics);

		$this->_attacker_fleet_details = $this->loadFleetDetails($attacker_ships, $attacker_ship_losses);
		$this->_defender_fleet_details = $this->loadFleetDetails($defender_ships, $defender_ship_losses);
		
	}
	
	/**
	 * @param array $ships
	 * @param array $ship_losses
	 * @return NULL
	 */
	private function loadFleetDetails($ships, $ship_losses) {
		
		$details = array();
		
		foreach ($ships as $data) {
			
			$combat_index = $data['owner'];
			
			if (!isset($details[$combat_index])) $details[$combat_index] = array();
			
			$details[$combat_index][$data['ship_type']] = new \stdClass();
			$details[$combat_index][$data['ship_type']]->ships = $data['count'];
			
		}
		
		foreach ($ship_losses as $data) {
												
			$details[$data['owner']][$data['ship_type']]->lost = (int)$data['count'];
				
		}
		
		return $details;
		
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
	 * @return array
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
	 * @return array
	 */
	public function getDefendersDetails() {
		
		return $this->_defender_fleet_details;
		
	}
		
}