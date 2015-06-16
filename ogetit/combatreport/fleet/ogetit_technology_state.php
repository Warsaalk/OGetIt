<?php
namespace OGetIt\CombatReport\Fleet;

use OGetIt\Technology\OGetIt_Technology;
use OGetIt\Technology\OGetIt_Technology_Combat;
use OGetIt\Common\OGetIt_Resources;

class OGetIt_Technology_State {
	
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
	 * @return Ambigous <number, boolean>
	 */
	public function getLost() {
		
		return $this->_lost;
		
	}
	
	/**
	 * @return OGetIt_Resources
	 */
	public function getValue() {
		
		return $this->_technology->getCosts($this->_count);
		
	}
	
}