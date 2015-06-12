<?php

namespace OGetIt\Common;

use OGetIt\Technology\OGetIt_Technology;

class OGetIt_Fleet {
	
	/**
	 * @var OGetIt_Planet
	 */
	private $_planet;
	
	/**
	 * @var OGetIt_Technology[]
	 */
	private $_technologies = array();
	
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
	 */
	public function addTechnology($technology, $count) {
		
		$techData = new \stdClass();
		$techData->technology = $technology;
		$techData->count = $count;
		
		$this->_technologies[$technology->getType()] = $techData;
		
	}
	
	/**
	 * @param integer $type
	 * @return \stdClass|NULL
	 */
	public function getTechnology($type) {
		
		return isset($this->_technologies[$type]) ? $this->_technologies[$type] : null;
		
	}
	
	/**
	 * @return \stdClass
	 */
	public function getTechnologies() {
		
		return $this->_technologies;
		
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
	
}