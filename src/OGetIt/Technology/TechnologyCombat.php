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
	public static $RAPIDFIRE_FROM = array();
	
	/**
	 * @var array
	 */
	public static $RAPIDFIRE_AGAINST = array();
	
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
				
	}

	/**
	 * @param base $level
	 * @param integer $level
	 * @return integer
	 */
	protected function getAddedValue($base, $level) {
		
		return $base * 0.1 * $level;
		
	}

	/**
	 * @param integer $level
	 * @return integer
	 */
	public function getArmor($level = 0) {
		
		return $this->ARMOR + $this->getAddedValue($this->ARMOR, $level);
		
	}

	/**
	 * @param integer $level
	 * @return integer
	 */
	public function getShield($level = 0) {
		
		return $this->SHIELD + $this->getAddedValue($this->SHIELD, $level);
		
	}

	/**
	 * @param integer $level
	 * @return integer
	 */
	public function getWeapon($level = 0) {
		
		return $this->WEAPON + $this->getAddedValue($this->WEAPON, $level);
		
	}

	/**
	 * @param integer $type (optional)
	 * @return array|integer
	 */
	public static function getRapidFireFrom($type = false) {
		
		if (is_int($type)) {
			if (isset(static::$RAPIDFIRE_FROM[$type])) return static::$RAPIDFIRE_FROM[$type];
			return 0;
		}
		
		return static::$RAPIDFIRE_FROM;
		
	}
	
	/**
	 * @param integer $type (optional)
	 * @return array|integer
	 */
	public static function getRapidFireAgainst($type = false) {
		
		if (is_int($type)) {
			if (isset(static::$RAPIDFIRE_AGAINST[$type])) return static::$RAPIDFIRE_AGAINST[$type]; 
			return 0;
		} 
		
		return static::$RAPIDFIRE_AGAINST;
		
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
			'rapidfire_from' => static::$RAPIDFIRE_FROM,
			'rapidfire_against' => static::$RAPIDFIRE_AGAINST
		), parent::jsonSerialize());
	}
	
}