<?php
namespace OGetIt\Technology;

use OGetIt\Common\OGetIt_Resources;

abstract class OGetIt_Technology {
	
	/**
	 * @var integer
	 */
	private $_type;
	
	/**
	 * @var OGetIt_Resources
	 */
	private $_resources;
	
	/**
	 * @param integer $type
	 * @param integer $metal
	 * @param integer $crystal
	 * @param integer $deuterium
	 */
	protected function __construct($type, $metal, $crystal, $deuterium) {
		
		$this->_type = $type;
		$this->_resources = new OGetIt_Resources($metal, $crystal, $deuterium);
		
	}
	
	/**
	 * @return integer
	 */
	public function getType() {
		
		return $this->_type;
		
	}
	
	/**
	 * @return OGetIt_Resources
	 */
	public function getResources() {
		
		return $this->_resources;
		
	}
	
	/**
	 * @param integer $count
	 * @return OGetIt_Resources
	 */
	public function getCosts($count = 1) {
		
		return new OGetIt_Resources(
			$this->_resources->getMetal() * $count,
			$this->_resources->getCrystal() * $count,
			$this->_resources->getDeuterium() * $count	
		);
		
	}
	
}