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
	 * @param integer $combat_index
	 * @return OGetIt_Player|NULL
	 */
	public function getPlayerByCombatIndex($combat_index) {
		
		foreach ($this->_players as $player) {
			
			if ($player->getCombatIndex() === $combat_index) return $player;
			
		}
		
		return null;
		
	}
	
}