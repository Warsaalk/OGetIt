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
namespace OGetIt\Technology\Entity\Ship; 

use OGetIt\Technology\TechnologyCombatFlyable;

class SolarSatellite extends TechnologyCombatFlyable {

	const TYPE = 212;
	
	const METAL = 0, CRYSTAL = 2000, DEUTERIUM = 500;
	
	const ARMOR = 2000, SHIELD = 1, WEAPON = 1;
	
	const SPEED = 0, CARGO_CAPACITY = 0, FUEL_USAGE = 0;
	
	public function __construct() {
		
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON, self::SPEED, self::CARGO_CAPACITY, self::FUEL_USAGE);
		
	}
	
	protected function setRapidFire() {
		
		$this->rapidfire_from = array(
				Battlecruiser::TYPE => 5,
				Destroyer::TYPE => 5,
				Bomber::TYPE => 5,
				Recycler::TYPE => 5,
				ColonyShip::TYPE => 5,
				Battleship::TYPE => 5,
				Cruiser::TYPE => 5,
				HeavyFighter::TYPE => 5,
				LightFighter::TYPE => 5,
				LargeCargo::TYPE => 5,
				Deathstar::TYPE => 1250,
				SmallCargo::TYPE => 5
		);
		
	}
	
}