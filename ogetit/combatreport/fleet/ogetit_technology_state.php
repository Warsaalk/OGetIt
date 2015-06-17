<?php
namespace OGetIt\CombatReport\Fleet;

use OGetIt\Technology\OGetIt_Technology;
use OGetIt\Technology\OGetIt_Technology_Combat;
use OGetIt\Common\OGetIt_Resources;
use OGetIt\Common\OGetIt_Value;

class OGetIt_Technology_State implements OGetIt_Value {
	
	/**
	 * @var OGetIt_Technology_Combat
	 */
	private $_technology;
	
	/**
	 * @var integer
	 */
	private $_count;
	
	/**
	 * @var integer|boolean
	 */
	private $_lost;	
	
	/**
	 * @param OGetIt_Technology_Combat $technology
	 * @param integer $count
	 * @param integer $lost
	 */
	public function __construct($technology, $count, $lost=false) {
		
		$this->_technology = $technology;
		$this->_count = $count;
		$this->_lost = $lost;
		
	}

	/**
	 * @return OGetIt_Technology
	 */
	public function getTechnology() {
		
		return $this->_technology;
		
	}	
	
	/**
	 * @return integer
	 */
	public function getCount() {
		
		return $this->_count;
		
	}
	
	/**
	 * @return integer|boolean
	 */
	public function getLost() {
		
		return $this->_lost;
		
	}
	
	/**
	 * @param boolean $byLosses
	 * @return OGetIt_Resources
	 */
	public function getValue($byLosses = false) {
		
		$count = $byLosses === true ? $this->_lost : $this->_count;
		
		return $this->_technology->getCosts($count);
		
	}
	
}