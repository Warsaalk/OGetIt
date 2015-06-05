<?php
namespace OGetIt\Technology;

/* TODO:: Maybe add Armor, schield, weapon & type */

abstract class OGetIt_Technology {
	
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
	 * @param integer $metal
	 * @param integer $crystal
	 * @param integer $deuterium
	 */
	protected function __construct($metal, $crystal, $deuterium) {
		
		$this->METAL = $metal;
		$this->CRYSTAL = $crystal;
		$this->DEUTERIUM = $deuterium;
		
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
	
}