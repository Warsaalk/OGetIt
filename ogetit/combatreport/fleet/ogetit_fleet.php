<?php

namespace OGetIt\CombatReport\Fleet;

use OGetIt\Technology\OGetIt_Technology;
use OGetIt\Common\OGetIt_Planet;
use OGetIt\Common\OGetIt_Resources;
use OGetIt\Common\OGetIt_Player;
use OGetIt;

class OGetIt_Fleet {
	
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
		
		$value = new OGetIt_Resources(0, 0, 0);
		
		foreach ($this->_state as $techState) {
			$value->add($techState->getValue($byLosses));
		}
		
		return $value;
		
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