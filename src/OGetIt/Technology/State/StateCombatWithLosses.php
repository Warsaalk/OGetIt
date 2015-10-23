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
namespace OGetIt\Technology\State;

use OGetIt\Technology\Technology;
use OGetIt\Common\Resources;
use OGetIt\Common\Value;
use OGetIt\Technology\TechnologyCombat;
use OGetIt\Common\Value\ChildLosses;

class StateCombatWithLosses extends StateCombat implements \JsonSerializable {
	
	use ChildLosses;
	
	/**
	 * @var integer
	 */
	private $lost;
	
	/**
	 * @param TechnologyCombat $technology
	 * @param integer $count
	 * @param integer $lost
	 */
	public function __construct(TechnologyCombat $technology, $count, $lost=false) {
		
		parent::__construct($technology, $count);
		
		$this->lost = $lost;
		
	}
	
	/**
	 * @return integer|boolean
	 */
	public function getLost() {
		
		return $this->lost;
		
	}
	
	/**
	 * @param integer $lost
	 */
	public function addLost($lost) {
		
		$this->lost += $lost;
		
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
		
		return $this->getTechnology()->getCosts($this->lost);
		
	}
	
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize() {
		return array_merge(array(
			'lost' => $this->lost
		), parent::jsonSerialize());
	}
	
}