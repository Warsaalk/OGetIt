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
	 * @return Resources
	 */
	public function getCosts($count = 1) {
		
		return new Resources(
			$this->getResources()->getMetal() * $count,
			$this->getResources()->getCrystal() * $count,
			$this->getResources()->getDeuterium() * $count	
		);
		
	}
	
}