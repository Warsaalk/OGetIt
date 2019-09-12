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
use OGetIt\Technology\Entity\Research\CombustionDrive;
use OGetIt\Technology\Entity\Research\ImpulseDrive;
use OGetIt\Technology\Entity\Research\HyperspaceDrive;

abstract class TechnologyCombatFlyable extends TechnologyCombat {

	/**
	 * @var array
	 */
	private $drivesSpeedPercentage = array(
		CombustionDrive::TYPE => 0.1,	
		ImpulseDrive::TYPE => 0.2,
		HyperspaceDrive::TYPE => 0.3
	);
	
	/**
	 * @var integer
	 */
	private $SPEED;

	/**
	 * @var integer
	 */	
	private $CARGO_CAPACITY;

	/**
	 * @var integer
	 */	
	private $FUEL_USAGE;

	/**
	 * TechnologyCombatFlyable constructor.
	 * @param integer $type
	 * @param integer $metal
	 * @param integer $crystal
	 * @param integer $deuterium
	 * @param integer $armor
	 * @param integer $shield
	 * @param integer $weapon
	 * @param integer $speed
	 * @param integer $cargo_capacity
	 * @param integer $fuel_usage
	 * @param integer $energy
	 */
	protected function __construct($type, $metal, $crystal, $deuterium, $armor, $shield, $weapon, $speed, $cargo_capacity, $fuel_usage, $energy = 0) {
		
		parent::__construct($type, $metal, $crystal, $deuterium, $armor, $shield, $weapon, $energy);
		
		$this->SPEED = $speed;
		$this->CARGO_CAPACITY = $cargo_capacity;
		$this->FUEL_USAGE = $fuel_usage;
		
	}
	
	/**
	 * @param integer $level
	 * @param integer $drive (optional) Type of drive
	 * @return integer
	 */
	public function getSpeed($level = 0, $drive = CombustionDrive::TYPE) {
		
		if ($drive !== CombustionDrive::TYPE && $drive !== ImpulseDrive::TYPE && $drive !== HyperspaceDrive::TYPE) {
			$drive = CombustionDrive::TYPE;
		}
		
		return $this->SPEED + $this->getAddedValue($this->SPEED, $level, $this->drivesSpeedPercentage[$drive]);
		
	}

	/**
	 * @return integer
	 */
	public function getCargoCapacity() {
		
		return $this->CARGO_CAPACITY;
		
	}

	/**
	 * @return integer
	 */
	public function getFuelUsage() {
		
		return $this->FUEL_USAGE;
		
	}
	
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize() {
		return array_merge(array(
			'speed' => $this->SPEED,
			'cargo_capacity' => $this->CARGO_CAPACITY,
			'fuel_usage' => $this->FUEL_USAGE
		), parent::jsonSerialize());
	}
	
}