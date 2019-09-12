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

class Pathfinder extends TechnologyCombatFlyable
{
	const TYPE = 219;
	
	const METAL = 8000, CRYSTAL = 15000, DEUTERIUM = 8000;
	
	const ARMOR = 23000, SHIELD = 100, WEAPON = 200;
	
	const SPEED = 12000, CARGO_CAPACITY = 10000, FUEL_USAGE = 300;
	
	public static $RAPIDFIRE_FROM = [
		Battleship::TYPE => 5,
		Deathstar::TYPE => 30
	];
		
	public static $RAPIDFIRE_AGAINST = [
		EspionageProbe::TYPE => 5,
		SolarSatellite::TYPE => 5,
		Crawler::TYPE => 5,
		Cruiser::TYPE => 3,
		LightFighter::TYPE => 3,
		HeavyFighter::TYPE => 2
	];
	
	public function __construct()
	{
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON, self::SPEED, self::CARGO_CAPACITY, self::FUEL_USAGE);
	}
}