<?php
namespace OGetIt\Technology;

use OGetIt\Common\OGetIt_Resources;
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
	
	/**
	 * @param integer $count
	 * @return OGetIt_Resources
	 */
	public function getCosts($count) {
		
		return new OGetIt_Resources(
			$this->getMetal() * $count,
			$this->getCrystal() * $count,
			$this->getDeuterium() * $count	
		);
		
	}
	
}