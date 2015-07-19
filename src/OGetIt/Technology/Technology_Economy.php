<?php
/*
 * Copyright © 2015 Klaas Van Parys
 * 
 * This file is part of OGetIt.
 * 
 * OGetIt is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * OGetIt is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public License
 * along with OGetIt.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace OGetIt\Technology;

use OGetIt\Common\Resources;

abstract class Technology_Economy extends Technology {
	
	/**
	 * @var integer
	 */
	protected $power_base = 2;
	
	/**
	 * @param integer $type
	 * @param integer $metal
	 * @param integer $crystal
	 * @param integer $deuterium
	 * @param integer $energy
	 */
	protected function __construct($type, $metal, $crystal, $deuterium, $energy = 0) {
		
		parent::__construct($type, $metal, $crystal, $deuterium, $energy);
	
	}
	
	/**
	 * @param integer $level
	 * @return Resources
	 */
	public function getCosts($level = 1) {
		
		$base = pow($this->power_base, $level);
		
		return new Resources(
			$this->getResources()->getMetal() * $base,
			$this->getResources()->getCrystal() * $base,
			$this->getResources()->getDeuterium() * $base,
			$this->getResources()->getEnergy() * $base
		);
		
	}
	
}