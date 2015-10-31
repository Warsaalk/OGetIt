<?php
/*
 * OGetIt, a open source PHP library for handling the new OGame API as of version 6.
 * Copyright (C) 2015  Klaas Van Parys
 * 
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 */
namespace OGetIt\Technology;

use OGetIt\Common\Resources;
abstract class TechnologyCombat extends Technology {

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
	 * @var array
	 */
	protected $rapidfire_from = array();
	
	/**
	 * @var array
	 */
	protected $rapidfire_against = array();
	
	/**
	 * @param integer $type
	 * @param integer $metal
	 * @param integer $crystal
	 * @param integer $deuterium
	 * @param integer $armor
	 * @param integer $shield
	 * @param integer $weapon
	 * @param array $rapidFireFrom
	 * @param array $rapidFireAgainst
	 */
	protected function __construct($type, $metal, $crystal, $deuterium, $armor, $shield, $weapon) {
		
		parent::__construct($type, $metal, $crystal, $deuterium);
		
		$this->ARMOR = $armor;
		$this->SHIELD = $shield;
		$this->WEAPON = $weapon;
		
		$this->setRapidFire();
		
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
	 * @return void
	 */
	protected abstract function setRapidFire();

	/**
	 * @param integer $type (optional)
	 * @return array|integer
	 */
	public function getRapidFireFrom($type = false) {
		
		if (is_int($type)) {
			if (isset($this->rapidFireFrom[$type])) return $this->rapidFireFrom[$type];
			return 0;
		}
		
		return $this->rapidFireFrom;
		
	}
	
	/**
	 * @param integer $type (optional)
	 * @return array|integer
	 */
	public function getRapidFireAgainst($type = false) {
		
		if (is_int($type)) {
			if (isset($this->rapidFireAgainst[$type])) return $this->rapidFireAgainst[$type]; 
			return 0;
		} 
		
		return $this->rapidFireAgainst;
		
	}
	
	/**
	 * @param integer $count
	 * @return Resources
	 */
	public function getCosts($count = 1) {
		
		return new Resources(
			$this->getResources()->getMetal() * $count,
			$this->getResources()->getCrystal() * $count,
			$this->getResources()->getDeuterium() * $count	
		);
		
	}
	
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize() {
		return array_merge(array(
			'armour' => $this->ARMOR,
			'shield' => $this->SHIELD,
			'weapon' => $this->WEAPON,
			'rapidfire_from' => $this->rapidfire_from,
			'rapidfire_against' => $this->rapidfire_against
		), parent::jsonSerialize());
	}
	
}