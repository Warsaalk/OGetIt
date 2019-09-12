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
use OGetIt\Technology\Entity\Defence\RocketLauncher;

class Cruiser extends TechnologyCombatFlyable
{
	const TYPE = 206;
	
	const METAL = 20000, CRYSTAL = 7000, DEUTERIUM = 2000;
	
	const ARMOR = 27000, SHIELD = 50, WEAPON = 400;
	
	const SPEED = 15000, CARGO_CAPACITY = 800, FUEL_USAGE = 300;
	
	public static $RAPIDFIRE_FROM = [
		Battlecruiser::TYPE => 4,
		Deathstar::TYPE => 33,
		Reaper::TYPE => 7,
		Pathfinder::TYPE => 3
	];
		
	public static $RAPIDFIRE_AGAINST = [
		EspionageProbe::TYPE => 5,
		SolarSatellite::TYPE => 5,
		Crawler::TYPE => 5,
		LightFighter::TYPE => 6,
		RocketLauncher::TYPE => 10
	];
		
	public function __construct()
	{
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON, self::SPEED, self::CARGO_CAPACITY, self::FUEL_USAGE);
	}
}