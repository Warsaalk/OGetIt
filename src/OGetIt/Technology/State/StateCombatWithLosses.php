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
use OGetIt\Common\Value\ChildLosses;

class StateCombatWithLosses extends StateCombat {
	
	use ChildLosses;
	
	/**
	 * @var integer
	 */
	private $_lost;
	
	/**
	 * @param TechnologyCombat $technology
	 * @param integer $count
	 * @param integer $lost
	 */
	public function __construct(TechnologyCombat $technology, $count, $lost=false) {
		
		parent::__construct($technology, $count);
		
		$this->_lost = $lost;
		
	}
	
	/**
	 * @return integer|boolean
	 */
	public function getLost() {
		
		return $this->_lost;
		
	}
	
	/**
	 * @param integer $lost
	 */
	public function addLost($lost) {
		
		$this->_lost += $lost;
		
	}
	
	/**
	 * @return Resources
	 */
	public function getValue() {
		
		return $this->getTechnology()->getCosts($this->getCount());
		
	}
	
	/**
	 * @return Resources
	 */
	public function getLosses() {
		
		return $this->getTechnology()->getCosts($this->_lost);
		
	}
	
}