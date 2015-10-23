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

class StateCombat extends State implements \JsonSerializable {
	
	/**
	 * @var integer
	 */
	private $count;
	
	/**
	 * @param TechnologyCombat $technology
	 * @param integer $count
	 */
	public function __construct(TechnologyCombat $technology, $count) {
		
		parent::__construct($technology);
		
		$this->count = $count;
		
	}
	
	/**
	 * @return integer
	 */
	public function getCount() {
		
		return $this->count;
		
	}
	
	/**
	 * @param integer $count
	 */
	public function addCount($count) {
		
		$this->count += $count;
		
	}
	
	/**
	 * @return Resources
	 */
	public function getValue() {
				
		return $this->getTechnology()->getCosts($this->count);
		
	}
	
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize() {
		return array_merge(array(
			'count' => $this->count
		), parent::jsonSerialize());
	}
	
}