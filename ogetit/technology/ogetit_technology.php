<?php
namespace OGetIt\Technology;

use OGetIt\Common\OGetIt_Resources;

abstract class OGetIt_Technology {
	
	/**
	 * @var integer
	 */
	private $_type;
	
	/**
	 * @var integer
	 */
	private $METAL;

	/**
	 * @var integer
	 */
	private $CRYSTAL;

	/**
	 * @var integer
	 */
	private $DEUTERIUM;
	
	/**
	 * @param integer $type
	 * @param integer $metal
	 * @param integer $crystal
	 * @param integer $deuterium
	 */
	protected function __construct($type, $metal, $crystal, $deuterium) {
		
		$this->_type = $type;
		
		$this->METAL = $metal;
		$this->CRYSTAL = $crystal;
		$this->DEUTERIUM = $deuterium;
		
	}
	
	/**
	 * @return integer
	 */
	public function getType() {
		
		return $this->_type;
		
	}
	
	/**
	 * @return integer
	 */
	public function getMetal() {
		
		return $this->METAL;
		
	}

	/**
	 * @return integer
	 */
	public function getCrystal() {
		
		return $this->CRYSTAL;
		
	}

	/**
	 * @return integer
	 */
	public function getDeuterium() {
		
		return $this->DEUTERIUM;
		
	}
	
	/**
	 * @param integer $count
	 * @return OGetIt_Resources
	 */
	public function getCosts($count = 1) {
		
		return new OGetIt_Resources(
			$this->getMetal() * $count,
			$this->getCrystal() * $count,
			$this->getDeuterium() * $count	
		);
		
	}
	
}