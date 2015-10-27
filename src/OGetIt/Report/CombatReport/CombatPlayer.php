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
	private $armor;
	
	/**
	 * @var integer
	 */
	private $shield;
	
	/**
	 * @var integer
	 */
	private $weapon;
	
	/**
	 * @var CombatFleet[]
	 */
	private $fleets = array();
	
	/**
	 * @param integer $armor
	 * @param integer $shield
	 * @param integer $weapon
	 */
	public function setCombatTechnologies($armor, $shield, $weapon) {
	
		$this->armor = $armor;
		$this->shield = $shield;
		$this->weapon = $weapon;
	
	}
	
	/**
	 * @param CombatFleet $fleet
	 */
	public function addFleet(CombatFleet $fleet) {
	
		$fleet->setPlayer($this);
		$this->fleets[] = $fleet;
	
	}
	
	/**
	 * @param CombatFleet $updatedFleet
	 */
	public function updateFleet(CombatFleet $updatedFleet) {
	
		foreach ($this->fleets as $i => $fleet) {
			if ($fleet->getCombatIndex() === $updatedFleet->getCombatIndex()) {
				$this->fleets[$i] = $updatedFleet;
				break;
			}
		}
	
	}
	
	/**
	 * @param integer $combat_index
	 * @return CombatFleet|NULL
	 */
	public function getFleetByCombatIndex($combat_index) {
	
		foreach ($this->fleets as $fleet) {
	
			if ($fleet->getCombatIndex() === $combat_index) return $fleet;
	
		}
	
		return null;
	
	}
	
	/**
	 * @return CombatFleet[]
	 */
	public function getFleets() {
	
		return $this->fleets;
	
	}
	
	/**
	 * @return Fleet
	 */
	public function getFleetsMerged() {
	
		$merged = new Fleet();
	
		foreach ($this->fleets as $fleet) {
			$merged->merge($fleet);
		}
	
		return $merged;
	
	}

	/**
	 * @return integer
	 */
	public function getArmor() {
	
		return $this->armor;
	
	}
	
	/**
	 * @return integer
	 */
	public function getShield() {
	
		return $this->shield;
	
	}
	
	/**
	 * @return integer
	 */
	public function getWeapon() {
	
		return $this->weapon;
	
	}
	
	public function __clone() {
	
		$fleets = array();
	
		foreach ($this->fleets as $fleet) {
			$clone = clone $fleet;
			$clone->setPlayer($this);
			$fleets[] = $clone;
		}
	
		$this->fleets = $fleets; //Clone the fleets
	
	}
	
	/**
	 * @return Resources
	 */
	public function getValue() {
	
		return $this->getChildrenValue($this->fleets);
	
	}
	
	/**
	 * @return Resources
	 */
	public function getLosses() {
		
		return $this->getChildrenLosses($this->fleets);
		
	}
	
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize() {
		return array_merge(array(
			'alliance' => $this->alliance,
			'armor' => $this->armor,
			'shield' => $this->shield,
			'weapon' => $this->weapon,
			'fleets' => $this->fleets
		), parent::jsonSerialize());
	}
	
}