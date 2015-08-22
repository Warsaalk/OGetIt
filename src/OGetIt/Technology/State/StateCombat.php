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
use OGetIt\Technology\TechnologyCombat;

class StateCombat extends State {
	
	/**
	 * @var integer
	 */
	private $_count;
	
	/**
	 * @param TechnologyCombat $technology
	 * @param integer $count
	 */
	public function __construct(TechnologyCombat $technology, $count) {
		
		parent::__construct($technology);
		
		$this->_count = $count;
		
	}
	
	/**
	 * @return integer
	 */
	public function getCount() {
		
		return $this->_count;
		
	}
	
	/**
	 * @param integer $count
	 */
	public function addCount($count) {
		
		$this->_count += $count;
		
	}
	
	/**
	 * @param boolean $byLosses
	 * @return Resources
	 */
	public function getValue($byLosses = false) {
				
		return $this->getTechnology()->getCosts($this->_count);
		
	}
	
}