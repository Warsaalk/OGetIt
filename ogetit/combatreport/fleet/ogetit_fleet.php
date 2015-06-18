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
namespace OGetIt\CombatReport\Fleet;

use OGetIt\Technology\OGetIt_Technology;
use OGetIt\Common\OGetIt_Planet;
use OGetIt\Common\OGetIt_Resources;
use OGetIt\Common\OGetIt_Player;
use OGetIt;
use OGetIt\Common\OGetIt_Value;
use OGetIt\CombatReport\Helper\OGetIt_Combat_ChildValue;

class OGetIt_Fleet implements OGetIt_Value {
	
	use OGetIt_Combat_ChildValue;
	
	/**
	 * @var OGetIt_Planet
	 */
	private $_planet;
	
	/**
	 * @var OGetIt_Player
	 */
	private $_player;
	
	/**
	 * @var OGetIt_Technology_State[] 
	 */
	private $_state = array();
	
	/**
	 * @var integer
	 */
	private $_combat_index;
	
	/**
	 * @param OGetIt_Planet $planet
	 * @parem integer $combat_index
	 */
	public function __construct($planet, $combat_index) {
		
		$this->_planet = $planet;
		$this->_combat_index = $combat_index;
		
	}
	
	/**
	 * @param OGetIt_Technology $technology
	 * @param integer $count
	 * @param integer $lost
	 */
	public function addTechnologyState($technology, $count, $lost = false) {
		
		$techState = new OGetIt_Technology_State(
			$technology, 
			$count, 
			$lost
		);
		
		$this->_state[$technology->getType()] = $techState;
		
	}
	
	/**
	 * @param integer $type
	 * @return OGetIt_Technology_State|NULL
	 */
	public function getTechnologyState($type) {
		
		return isset($this->_state[$type]) ? $this->_state[$type] : null;
		
	}
	
	/**
	 * @return \stdClass
	 */
	public function getTechnologyStates() {
		
		return $this->_state;
		
	}
	
	/**
	 * @param OGetIt_Player $player
	 */
	public function setPlayer(OGetIt_Player $player) {
		
		$this->_player = $player;
		
	}
	
	/**
	 * @return OGetIt_Player
	 */
	public function getPlayer() {
		
		return $this->_player;
		
	}
	
	/**
	 * @return OGetIt_Planet
	 */
	public function getPlanet() {
		
		return $this->_planet;
		
	}
	
	/**
	 * @return integer
	 */
	public function getCombatIndex() {
		
		return $this->_combat_index;
		
	}
	

	public function __clone() {
	
		$this->_state = array(); //Clear state
	
	}
	
	/**
	 * @param boolean $byLosses
	 * @return OGetIt_Resources
	 */
	public function getValue($byLosses = false) {
		
		return $this->getChildrenValue($this->_state, $byLosses);
		
	}
	
	/**
	 * @param OGetIt_Fleet $other
	 * @return OGetIt_Fleet
	 */
	public function difference(OGetIt_Fleet $other) {
		
		$fleet = clone $other;
		
		foreach ($this->_state as $type => $techState) {
			
			$count = $other->getTechnologyState($type) !== null ? $other->getTechnologyState($type)->getCount() : 0;
			$lost = $techState->getCount() - $count;
			
			$fleet->addTechnologyState($techState->getTechnology(), $count, $lost);
			
		}
		
		return $fleet;
		
	}
	
}