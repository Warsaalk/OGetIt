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
use OGetIt\Report\CombatReport\Fleet\Fleet;
use OGetIt\Common\Value\ChildValueAndLosses;
use OGetIt\Report\CombatReport\Fleet\CombatFleet;
use OGetIt\Common\AllianceTrait;

class CombatPlayer extends Player {

	use ChildValueAndLosses;
	use AllianceTrait;

	/**
	 * @var integer
	 */
	private $_armor;
	
	/**
	 * @var integer
	 */
	private $_shield;
	
	/**
	 * @var integer
	 */
	private $_weapon;
	
	/**
	 * @var CombatFleet[]
	 */
	private $_fleets = array();
	
	/**
	 * @param integer $armor
	 * @param integer $shield
	 * @param integer $weapon
	 */
	public function setCombatTechnologies($armor, $shield, $weapon) {
	
		$this->_armor = $armor;
		$this->_shield = $shield;
		$this->_weapon = $weapon;
	
	}
	
	/**
	 * @param CombatFleet $fleet
	 */
	public function addFleet(CombatFleet $fleet) {
	
		$fleet->setPlayer($this);
		$this->_fleets[] = $fleet;
	
	}
	
	/**
	 * @param CombatFleet $updatedFleet
	 */
	public function updateFleet(CombatFleet $updatedFleet) {
	
		foreach ($this->_fleets as $i => $fleet) {
			if ($fleet->getCombatIndex() === $updatedFleet->getCombatIndex()) {
				$this->_fleets[$i] = $updatedFleet;
				break;
			}
		}
	
	}
	
	/**
	 * @param integer $combat_index
	 * @return CombatFleet|NULL
	 */
	public function getFleetByCombatIndex($combat_index) {
	
		foreach ($this->_fleets as $fleet) {
	
			if ($fleet->getCombatIndex() === $combat_index) return $fleet;
	
		}
	
		return null;
	
	}
	
	/**
	 * @return CombatFleet[]
	 */
	public function getFleets() {
	
		return $this->_fleets;
	
	}
	
	/**
	 * @return Fleet
	 */
	public function getFleetsMerged() {
	
		$merged = new Fleet();
	
		foreach ($this->_fleets as $fleet) {
			$merged->merge($fleet);
		}
	
		return $merged;
	
	}

	/**
	 * @return integer
	 */
	public function getArmor() {
	
		return $this->_armor;
	
	}
	
	/**
	 * @return integer
	 */
	public function getShield() {
	
		return $this->_shield;
	
	}
	
	/**
	 * @return integer
	 */
	public function getWeapon() {
	
		return $this->_weapon;
	
	}
	
	public function __clone() {
	
		$fleets = array();
	
		foreach ($this->_fleets as $fleet) {
			$clone = clone $fleet;
			$clone->setPlayer($this);
			$fleets[] = $clone;
		}
	
		$this->_fleets = $fleets; //Clone the fleets
	
	}
	
	/**
	 * @return Resources
	 */
	public function getValue() {
	
		return $this->getChildrenValue($this->_fleets);
	
	}
	
	/**
	 * @return Resources
	 */
	public function getLosses() {
		
		return $this->getChildrenLosses($this->_fleets);
		
	}
	
}