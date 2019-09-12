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

class LightFighter extends TechnologyCombatFlyable
{
	const TYPE = 204;
	
	const METAL = 3000, CRYSTAL = 1000, DEUTERIUM = 0;
	
	const ARMOR = 4000, SHIELD = 10, WEAPON = 50;
	
	const SPEED = 12500, CARGO_CAPACITY = 50, FUEL_USAGE = 20;
	
	public static $RAPIDFIRE_FROM = [
		Cruiser::TYPE => 6,
		Deathstar::TYPE => 200,
		Pathfinder::TYPE => 3
	];
		
	public static $RAPIDFIRE_AGAINST = [
		EspionageProbe::TYPE => 5,
		SolarSatellite::TYPE => 5,
		Crawler::TYPE => 5
	];
	
	public function __construct()
	{
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON, self::SPEED, self::CARGO_CAPACITY, self::FUEL_USAGE);
	}
}