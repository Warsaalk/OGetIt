<?php
namespace OGetIt\Common;

class OGetIt_Resources {
	
	/**
	 * @var integer
	 */
	private $_metal;

	/**
	 * @var integer
	 */
	private $_crystal;

	/**
	 * @var integer
	 */
	private $_deuterium;
	
	/**
	 * @param integer $metal
	 * @param integer $crystal
	 * @param integer $deuterium
	 */
	public function __construct($metal, $crystal, $deuterium) {
		
		$this->_metal = $metal;
		$this->_crystal = $crystal;
		$this->_deuterium = $deuterium;
		
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

	/**
	 * @return integer
	 */
	public function getDeuterium() {
		
		return $this->_deuterium;
		
	}
	
}