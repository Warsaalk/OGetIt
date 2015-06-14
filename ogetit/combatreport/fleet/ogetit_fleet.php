<?php

namespace OGetIt\CombatReport\Fleet;

use OGetIt\Technology\OGetIt_Technology;
use OGetIt\Common\OGetIt_Planet;

class OGetIt_Fleet {
	
	/**
	 * @var OGetIt_Planet
	 */
	private $_planet;
	
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
	 * @return \stdClass|NULL
	 */
	public function getTechnologyState($type) {
		
		return isset($this->_state[$type]) ? $this->_state[$type] : null;
		
	}
	
	/**
	 * @return \stdClass
	 */
	public function getTechnologies() {
		
		return $this->_state;
		
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
	
}