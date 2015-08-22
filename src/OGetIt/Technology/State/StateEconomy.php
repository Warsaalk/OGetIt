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
namespace OGetIt\Technology\State;

use OGetIt\Technology\Technology;
use OGetIt\Common\Resources;
use OGetIt\Common\Value;
use OGetIt\Technology\TechnologyEconomy;

class StateEconomy extends State {
	
	/**
	 * @var integer
	 */
	private $_level;
	
	/**
	 * @param TechnologyCombat $technology
	 * @param integer $level
	 */
	public function __construct(TechnologyEconomy $technology, $level) {
		
		parent::__construct($technology);
		
		$this->_level = $level;
		
	}
	
	/**
	 * @return integer
	 */
	public function getLevel() {
		
		return $this->_level;
		
	}
	
	/**
	 * @param boolean $byLosses
	 * @return Resources
	 */
	public function getValue($byLosses = false) {
				
		return $this->getTechnology()->getCosts($this->_level);
		
	}
	
}