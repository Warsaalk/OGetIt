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

use OGetIt\Technology\TechnologyCombat;
use OGetIt\Technology\Entity\Ship\Deathstar;

class GaussCannon extends TechnologyCombat {

	const TYPE = 404;
	
	const METAL = 20000, CRYSTAL = 15000, DEUTERIUM = 2000;
	
	const ARMOR = 35000, SHIELD = 200, WEAPON = 1100;
	
	public function __construct() {
		
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON);
		
	}
	
	protected function setRapidFire() {
		
		$this->rapidfire_from = array(
				Deathstar::TYPE => 50
		);
		
	}
	
}