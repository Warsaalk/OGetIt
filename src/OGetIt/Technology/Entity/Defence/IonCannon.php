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
namespace OGetIt\Technology\Entity\Defence; 

use OGetIt\Technology\Entity\Ship\Reaper;
use OGetIt\Technology\TechnologyCombat;
use OGetIt\Technology\Entity\Ship\Bomber;
use OGetIt\Technology\Entity\Ship\Deathstar;

class IonCannon extends TechnologyCombat
{
	const TYPE = 405;
	
	const METAL = 5000, CRYSTAL = 3000, DEUTERIUM = 0;
	
	const ARMOR = 8000, SHIELD = 150, WEAPON = 500;
	
	public static $RAPIDFIRE_FROM = [
		Bomber::TYPE => 10,
		Deathstar::TYPE => 100
	];

	public static $RAPIDFIRE_AGAINST = [
		Reaper::TYPE => 2
	];
	
	public function __construct()
	{
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON);
	}
}