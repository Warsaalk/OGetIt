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

abstract class Technology {
	
	/**
	 * @var integer
	 */
	private $_type;
	
	/**
	 * @var Resources
	 */
	private $_resources;
	
	/**
	 * @param integer $type
	 * @param integer $metal
	 * @param integer $crystal
	 * @param integer $deuterium
	 */
	protected function __construct($type, $metal, $crystal, $deuterium) {
		
		$this->_type = $type;
		$this->_resources = new Resources($metal, $crystal, $deuterium);
		
	}
	
	/**
	 * @return integer
	 */
	public function getType() {
		
		return $this->_type;
		
	}
	
	/**
	 * @return Resources
	 */
	public function getResources() {
		
		return $this->_resources;
		
	}
	
	/**
	 * @param integer $count
	 * @return Resources
	 */
	public function getCosts($count = 1) {
		
		return new Resources(
			$this->_resources->getMetal() * $count,
			$this->_resources->getCrystal() * $count,
			$this->_resources->getDeuterium() * $count	
		);
		
	}
	
}