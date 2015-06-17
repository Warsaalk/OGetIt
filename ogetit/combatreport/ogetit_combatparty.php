<?php

namespace OGetIt\CombatReport;

use OGetIt\Common\OGetIt_Player;

class OGetIt_CombatParty {

	/**
	 * @var integer
	 */
	private $_count;
	
	/**
	 * @var integer
	 */
	private $_total_losses;
	
	/**
	 * @var OGetIt_Player[]
	 */
	private $_players;
	
	/**
	 * @param integer $count
	 * @param integer $losses
	 */
	public function __construct($count, $losses) {
		
		$this->_count = $count;
		$this->_total_losses = $losses;
		
	}
	
	/**
	 * @param OGetIt_Player[] $players
	 */
	public function setPlayers(array $players) {
		
		$this->_players = $players;
		
	}

	/**
	 * @return integer
	 */
	public function getCount() {
		
		return $this->_count;
		
	}
	
	/**
	 * @return integer
	 */
	public function getTotalLosses() {
		
		return $this->_total_losses;
		
	}
	
	/**
	 * @return OGetIt_Player[]
	 */
	public function getPlayers() {
		
		return $this->_players;
		
	}
	
	/**
	 * @param integer $combat_index
	 * @return OGetIt_Player|NULL
	 */
	public function getPlayerByCombatIndex($combat_index) {
		
		foreach ($this->_players as $player) {
			
			if ($player->getFleetByCombatIndex($combat_index) !== null) return $player;
			
		}
		
		return null;
		
	}
	
	/**
	 * @param integer $combat_index
	 * @return OGetIt_Fleet\NULL
	 */
	public function getFleetByCombatIndex($combat_index) {
		
		foreach ($this->_players as $player) {
				
			if (($fleet = $player->getFleetByCombatIndex($combat_index)) !== null) return $fleet;
				
		}
		
		return null;
		
	}
	
	public function __clone() {
		
		$players = array();
		
		foreach($this->_players as $id => $player) {
			$players[$id] = clone $player;
		}
		
		$this->setPlayers($players);
		
	}
	
}