<?php
namespace OGetIt\HarvestReport;

class OGetIt_HarvestReport {

	/**
	 * @var string
	 */
	private $_coordinates;

	/**
	 * @var integer
	 */
	private $_metal;
	
	/**
	 * @var integer
	 */
	private $_crystal;
	
	/**
	 * @param unknown $coordinates Format; 1:100:10
	 * @param integer $metal
	 * @param integer $crystal
	 */
	public function __construct($coordinates, $metal, $crystal) {
		
		$this->_coordinates = $coordinates;
		$this->_metal = $metal;
		$this->_crystal = $crystal;
		
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
		
		return $this->_metal;
		
	}

	/**
	 * @return integer
	 */
	public function getCrystal() {
		
		return $this->_crystal;
		
	}
	
}