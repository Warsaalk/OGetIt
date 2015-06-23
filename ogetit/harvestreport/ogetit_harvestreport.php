<?php
namespace OGetIt\HarvestReport;

use OGetIt\Common\OGetIt_Resources;
class OGetIt_HarvestReport {

	/**
	 * @var string
	 */
	private $_coordinates;

	/**
	 * @var OGetIt_Resources
	 */
	private $_resources;
	
	/**
	 * @param unknown $coordinates Format; 1:100:10
	 * @param integer $metal
	 * @param integer $crystal
	 */
	public function __construct($coordinates, $metal, $crystal) {
		
		$this->_coordinates = $coordinates;
		$this->_resources = new OGetIt_Resources($metal, $crystal, 0);
		
	}
	
	/**
	 * @return string
	 */
	public function getCoordinates() {
		
		return $this->_coordinates;
		
	}
	
	/**
	 * @return integer
	 */
	public function getMetal() {
		
		return $this->_resources->getMetal();
		
	}

	/**
	 * @return integer
	 */
	public function getCrystal() {
		
		return $this->_resources->getCrystal();
		
	}
	
	/**
	 * @return OGetIt_Resources
	 */
	public function getResources() {
		
		return $this->_resources;
		
	}
	
}