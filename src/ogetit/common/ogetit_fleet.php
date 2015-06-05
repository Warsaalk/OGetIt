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
	 * @param OGetIt_Planet $planet
	 */
	public function __construct($planet) {
		
		$this->_planet = $planet;
		
	}
	
	/**
	 * @param OGetIt_Technology $technology
	 */
	public function addTechnology($technology, $count) {
		
		$techData = new \stdClass();
		$techData->technology = $technology;
		$techData->count = $count;
		
		$this->_technologies[] = $techData;
		
	}
	
	/**
	 * @return OGetIt_Planet
	 */
	public function getPlanet() {
		
		return $this->_planet;
		
	}
	
}