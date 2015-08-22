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
namespace OGetIt\Report\CombatReport\Fleet;

use OGetIt\Technology\Technology;
use OGetIt\Common\Planet;
use OGetIt\Common\Resources;
use OGetIt\Common\Player;
use OGetIt;
use OGetIt\Common\Value;
use OGetIt\Report\CombatReport\Helper\Combat_ChildValue;
use OGetIt\Report\CombatReport\CombatPlayer;
use OGetIt\Technology\State\StateCombatWithLosses;

class Fleet implements Value {
	
	use Combat_ChildValue;
	
	/**
	 * @var Planet
	 */
	private $_planet;
	
	/**
	 * @var CombatPlayer
	 */
	private $_player;
	
	/**
	 * @var StateCombatWithLosses[] 
	 */
	private $_state = array();
	
	/**
	 * @var integer
	 */
	private $_combat_index;
	
	/**
	 * @param Planet $planet
	 * @parem integer $combat_index
	 */
	public function __construct($planet = null, $combat_index = null) {
		
		$this->_planet = $planet;
		$this->_combat_index = $combat_index;
		
	}
	
	/**
	 * @param Technology $technology
	 * @param integer $count
	 * @param integer $lost
	 */
	public function addTechnologyState($technology, $count, $lost = false) {
		
		if (isset($this->_state[$technology->getType()])) {
			
			$this->_state[$technology->getType()]->addCount($count);
			if ($lost !== false) {
				$this->_state[$technology->getType()]->addLost($lost);
			}
			
		} else {
		
			$techState = new StateCombatWithLosses(
				$technology, 
				$count, 
				$lost
			);
			
			$this->_state[$technology->getType()] = $techState;
			
		}
		
	}
	
	/**
	 * @param integer $type
	 * @return StateCombatWithLosses|NULL
	 */
	public function getTechnologyState($type) {
		
		return isset($this->_state[$type]) ? $this->_state[$type] : null;
		
	}
	
	/**
	 * @return StateCombatWithLosses[]
	 */
	public function getTechnologyStates() {
		
		return $this->_state;
		
	}
	
	/**
	 * @param CombatPlayer $player
	 */
	public function setPlayer(CombatPlayer $player) {
		
		$this->_player = $player;
		
	}
	
	/**
	 * @return CombatPlayer
	 */
	public function getPlayer() {
		
		return $this->_player;
		
	}
	
	/**
	 * @return Planet
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
	 * @param Fleet $fleet
	 */
	public function merge(Fleet $fleet) {
		
		foreach ($fleet->getTechnologyStates() as $techState) {
			
			$this->addTechnologyState(
				$techState->getTechnology(), 
				$techState->getCount(),
				$techState->getLost()
			);
			
		}
		
	}
	
	/**
	 * @param boolean $byLosses
	 * @return Resources
	 */
	public function getValue($byLosses = false) {
		
		return $this->getChildrenValue($this->_state, $byLosses);
		
	}
	
	/**
	 * @param Fleet $other
	 * @return Fleet
	 */
	public function difference(Fleet $other) {
		
		$fleet = clone $other;
		
		foreach ($this->_state as $type => $techState) {
			
			$count = $other->getTechnologyState($type) !== null ? $other->getTechnologyState($type)->getCount() : 0;
			$lost = $techState->getCount() - $count;
			
			$fleet->addTechnologyState($techState->getTechnology(), $count, $lost);
			
		}
		
		return $fleet;
		
	}
	
}