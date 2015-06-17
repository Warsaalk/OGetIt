<?php

namespace OGetIt\Common;

use OGetIt\CombatReport\Fleet\OGetIt_Fleet;
use OGetIt\CombatReport\Helper\OGetIt_Combat_ChildValue;

class OGetIt_Player implements OGetIt_Value {

	use OGetIt_Combat_ChildValue;
	
	/**
	 * @var integer
	 */
	private $_id;
	
	/**
	 * @var string
	 */
	private $_name;
	
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
	 * @var OGetIt_Fleet[]
	 */
	private $_fleets = array();
	
	/**
	 * @param string $name
	 * @param integer $id
	 */
	public function __construct($name, $id = null) {
		
		$this->_name = $name;
		$this->_id = $id;
		
	}
	
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
	 * @param OGetIt_Fleet $fleet
	 */
	public function addFleet(OGetIt_Fleet $fleet) {
		
		$fleet->setPlayer($this);
		$this->_fleets[] = $fleet;
		
	}
	
	/**
	 * @param OGetIt_Fleet $updatedFleet
	 */
	public function updateFleet(OGetIt_Fleet $updatedFleet) {
		
		foreach ($this->_fleets as $i => $fleet) {
			if ($fleet->getCombatIndex() === $updatedFleet->getCombatIndex()) {
				$this->_fleets[$i] = $updatedFleet;
				break;
			}
		}
		
	}

	/**
	 * @param integer $combat_index
	 * @return OGetIt_Fleet|NULL
	 */
	public function getFleetByCombatIndex($combat_index) {
		
		foreach ($this->_fleets as $fleet) {
				
			if ($fleet->getCombatIndex() === $combat_index) return $fleet;
				
		}
		
		return null;
		
	}
	
	/**
	 * @param boolean $byLosses
	 * @return OGetIt_Resources
	 */
	public function getValue($byLosses = false) {
		
		return $this->getChildrenValue($this->_fleets, $byLosses);
		
	}
	
	/**
	 * @return integer
	 */
	public function getId() {
		
		return $this->_id;
		
	}
	
	/**
	 * @return string
	 */
	public function getName() {
		
		return $this->_name;
		
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
	
	/**
	 * @return OGetIt_Fleet[]
	 */
	public function getFleets() {
		
		return $this->_fleets;
		
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
	
}