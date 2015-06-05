<?php
namespace OGetIt\Technology;

abstract class OGetIt_Technology_Combat extends OGetIt_Technology {

	/**
	 * @var integer
	 */
	private $ARMOR;

	/**
	 * @var integer
	 */
	private $SHIELD;

	/**
	 * @var integer
	 */
	private $WEAPON;
	
	/**
	 * @param integer $type
	 * @param integer $metal
	 * @param integer $crystal
	 * @param integer $deuterium
	 */
	protected function __construct($type, $metal, $crystal, $deuterium, $armor, $shield, $weapon) {
		
		parent::__construct($type, $metal, $crystal, $deuterium);
		
		$this->ARMOR = $armor;
		$this->SHIELD = $shield;
		$this->WEAPON = $weapon;
		
	}

	/**
	 * @return integer
	 */
	public function getArmor() {
		
		return $this->ARMOR;
		
	}

	/**
	 * @return integer
	 */
	public function getShield() {
		
		return $this->SHIELD;
		
	}

	/**
	 * @return integer
	 */
	public function getWeapon() {
		
		return $this->WEAPON;
		
	}
	
}