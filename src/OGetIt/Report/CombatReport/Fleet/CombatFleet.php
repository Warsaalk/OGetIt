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
namespace OGetIt\Report\CombatReport\Fleet;

use OGetIt\Technology\Technology;
use OGetIt\Common\Planet;
use OGetIt\Common\Resources;
use OGetIt\Common\Player;
use OGetIt;
use OGetIt\Report\CombatReport\CombatPlayer;
use OGetIt\Technology\State\StateCombatWithLosses;
use OGetIt\Common\PlanetTrait;
use OGetIt\Common\Value\ChildValueAndLosses;

class CombatFleet extends Fleet {
	
	use PlanetTrait;
	
	/**
	 * @var integer
	 */
	private $_combat_index;
	
	/**
	 * @param Planet $planet
	 * @param integer $combat_index
	 */
	public function __construct(Planet $planet, $combat_index) {
		
		$this->setPlanet($planet);
		$this->_combat_index = $combat_index;
		
	}
	
	/**
	 * @return integer
	 */
	public function getCombatIndex() {
		
		return $this->_combat_index;
		
	}
	
}