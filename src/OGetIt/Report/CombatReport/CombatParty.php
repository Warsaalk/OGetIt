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
namespace OGetIt\Report\CombatReport;

use OGetIt\Common\Player;
use OGetIt\Common\Value;
use OGetIt\Report\HarvestReport\HarvestReport;
use OGetIt\Common\Value\ChildValueAndLosses;
use OGetIt\Report\CombatReport\Fleet\CombatFleet;

class CombatParty {

	use ChildValueAndLosses;
	
	/**
	 * @var integer
	 */
	private $_count;
	
	/**
	 * @var integer
	 */
	private $_total_losses;

	/**
	 * @var integer
	 */
	private $_honourable;

	/**
	 * @var integer
	 */
	private $_honourpoints;
	
	/**
	 * @var CombatPlayer[]
	 */
	private $_players;
	
	/**
	 * @var HarvestReport[]
	 */
	private $_harvestreports = array();
	
	/**
	 * @param integer $count
	 * @param integer $losses
	 * @param 
	 */
	public function __construct($count, $losses, $honourable, $honourpoints) {
		
		$this->_count = $count;
		$this->_total_losses = $losses;
		$this->_honourable = $honourable;
		$this->_honourpoints = $honourpoints;
		
	}
	
	/**
	 * @param CombatPlayer[] $players
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
	 * @return CombatPlayer[]
	 */
	public function getPlayers() {
		
		return $this->_players;
		
	}
	
	/**
	 * @param integer $combat_index
	 * @return CombatPlayer|NULL
	 */
	public function getPlayerByCombatIndex($combat_index) {
		
		foreach ($this->_players as $player) {
			
			if ($player->getFleetByCombatIndex($combat_index) !== null) return $player;
			
		}
		
		return null;
		
	}
	
	/**
	 * @param integer $combat_index
	 * @return CombatFleet\NULL
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
	
	/**
	 * @param HarvestReport $harvestreport
	 */
	public function addHarvestReport(HarvestReport $harvestreport) {
		
		$this->_harvestreports[] = $harvestreport;
		
	}
	
	/**
	 * @return HarvestReport[]
	 */
	public function getHarvestReports() {
		
		return $this->_harvestreports;
		
	}
	
	/**
	 * @return Resources
	 */
	public function getValue() {
	
		return $this->getChildrenValue($this->_players);
	
	}
	
	/**
	 * @return Resources
	 */
	public function getLosses() {
		
		return $this->getChildrenLosses($this->_players);
		
	}
	
	/**
	 * @return boolean
	 */
	public function getHonourable() {
		
		return $this->_honourable;
		
	}
	
	/**
	 * @return integer
	 */
	public function getHonourPoints() {
		
		return $this->_honourpoints;
		
	}
	
}