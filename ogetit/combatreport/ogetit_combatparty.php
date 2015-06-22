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

use OGetIt\Common\OGetIt_Player;
use OGetIt\Common\OGetIt_Value;
use OGetIt\CombatReport\Helper\OGetIt_Combat_ChildValue;
use OGetIt\HarvestReport\OGetIt_HarvestReport;

class OGetIt_CombatParty implements OGetIt_Value {

	use OGetIt_Combat_ChildValue;
	
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
	 * @var OGetIt_HarvestReport[]
	 */
	private $_harvestreports;
	
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
	
	/**
	 * @param boolean $byLosses
	 * @return OGetIt_Resources
	 */
	public function getValue($byLosses = false) {
		
		return $this->getChildrenValue($this->_players, $byLosses);
		
	}
	
	public function __clone() {
		
		$players = array();
		
		foreach($this->_players as $id => $player) {
			$players[$id] = clone $player;
		}
		
		$this->setPlayers($players);
		
	}
	
	/**
	 * @param OGetIt_HarvestReport $harvestreport
	 */
	public function addHarvestReport(OGetIt_HarvestReport $harvestreport) {
		
		$this->_harvestreports[] = $harvestreport;
		
	}
	
	/**
	 * @return OGetIt_HarvestReport
	 */
	public function getHarvestReport() {
		
		return $this->_harvestreports;
		
	}
	
}