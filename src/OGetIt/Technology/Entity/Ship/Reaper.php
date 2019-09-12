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

use OGetIt\Technology\Entity\Defence\IonCannon;
use OGetIt\Technology\TechnologyCombatFlyable;

class Reaper extends TechnologyCombatFlyable
{
	const TYPE = 218;
	
	const METAL = 85000, CRYSTAL = 55000, DEUTERIUM = 20000;
	
	const ARMOR = 140000, SHIELD = 700, WEAPON = 2800;
	
	const SPEED = 9000, CARGO_CAPACITY = 10000, FUEL_USAGE = 450;
	
	public static $RAPIDFIRE_FROM = [
		Deathstar::TYPE => 10,
		IonCannon::TYPE => 2
	];
		
	public static $RAPIDFIRE_AGAINST = [
		EspionageProbe::TYPE => 5,
		SolarSatellite::TYPE => 5,
		Crawler::TYPE => 5,
		Cruiser::TYPE => 7,
		Battleship::TYPE => 7,
		Bomber::TYPE => 4,
		Destroyer::TYPE => 3
	];
	
	public function __construct()
	{
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON, self::SPEED, self::CARGO_CAPACITY, self::FUEL_USAGE);
	}
}