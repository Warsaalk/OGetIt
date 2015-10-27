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

use OGetIt\Common\Player;
use OGetIt\Common\Value;
use OGetIt\Report\HarvestReport\HarvestReport;
use OGetIt\Common\Value\ChildValueAndLosses;
use OGetIt\Report\CombatReport\Fleet\CombatFleet;

class CombatParty implements \JsonSerializable {

	use ChildValueAndLosses;
	
	/**
	 * @var integer
	 */
	private $count;
	
	/**
	 * @var integer
	 */
	private $total_losses;

	/**
	 * @var integer
	 */
	private $honourable;

	/**
	 * @var integer
	 */
	private $honourpoints;
	
	/**
	 * @var CombatPlayer[]
	 */
	private $players;
	
	/**
	 * @var HarvestReport[]
	 */
	private $harvestreports = array();
	
	/**
	 * @param integer $count
	 * @param integer $losses
	 * @param 
	 */
	public function __construct($count, $losses, $honourable, $honourpoints) {
		
		$this->count = $count;
		$this->total_losses = $losses;
		$this->honourable = $honourable;
		$this->honourpoints = $honourpoints;
		
	}
	
	/**
	 * @param CombatPlayer[] $players
	 */
	public function setPlayers(array $players) {
		
		$this->players = $players;
		
	}

	/**
	 * @return integer
	 */
	public function getCount() {
		
		return $this->count;
		
	}
	
	/**
	 * @return integer
	 */
	public function getTotalLosses() {
		
		return $this->total_losses;
		
	}
	
	/**
	 * @return CombatPlayer[]
	 */
	public function getPlayers() {
		
		return $this->players;
		
	}
	
	/**
	 * @param integer $combat_index
	 * @return CombatPlayer|NULL
	 */
	public function getPlayerByCombatIndex($combat_index) {
		
		foreach ($this->players as $player) {
			
			if ($player->getFleetByCombatIndex($combat_index) !== null) return $player;
			
		}
		
		return null;
		
	}
	
	/**
	 * @param integer $combat_index
	 * @return CombatFleet\NULL
	 */
	public function getFleetByCombatIndex($combat_index) {
		
		foreach ($this->players as $player) {
				
			if (($fleet = $player->getFleetByCombatIndex($combat_index)) !== null) return $fleet;
				
		}
		
		return null;
		
	}
	
	public function __clone() {
		
		$players = array();
		
		foreach($this->players as $id => $player) {
			$players[$id] = clone $player;
		}
		
		$this->setPlayers($players);
		
	}
	
	/**
	 * @param HarvestReport $harvestreport
	 */
	public function addHarvestReport(HarvestReport $harvestreport) {
		
		$this->harvestreports[] = $harvestreport;
		
	}
	
	/**
	 * @return HarvestReport[]
	 */
	public function getHarvestReports() {
		
		return $this->harvestreports;
		
	}
	
	/**
	 * @return Resources
	 */
	public function getValue() {
	
		return $this->getChildrenValue($this->players);
	
	}
	
	/**
	 * @return Resources
	 */
	public function getLosses() {
		
		return $this->getChildrenLosses($this->players);
		
	}
	
	/**
	 * @return boolean
	 */
	public function getHonourable() {
		
		return $this->honourable;
		
	}
	
	/**
	 * @return integer
	 */
	public function getHonourPoints() {
		
		return $this->honourpoints;
		
	}
	
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize() {
		return array(
			'count' => $this->count,
			'total_losses' => $this->total_losses,
			'honourable' => $this->honourable,
			'honourpoints' => $this->honourpoints,
			'players' => $this->players,
			'harvestreports' => $this->harvestreports
		);
	}
	
}