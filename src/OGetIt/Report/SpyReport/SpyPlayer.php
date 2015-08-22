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
namespace OGetIt\Report\SpyReport;

use OGetIt\Common\Player;
use OGetIt\Common\Planet;

class SpyPlayer extends Player {
	
	private $_planet;
	
	/**
	 * @param Planet $planet
	 */
	public function setPlanet(Planet $planet) {
		
		$this->_planet = $planet;
		
	}
	
	/**
	 * @return Planet
	 */
	public function getPlanet() {
		
		return $this->_planet;
		
	}
	
}