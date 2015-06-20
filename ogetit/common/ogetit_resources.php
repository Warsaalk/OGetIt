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
namespace OGetIt\Common;

class OGetIt_Resources {
	
	/**
	 * @var integer
	 */
	private $_metal;

	/**
	 * @var integer
	 */
	private $_crystal;

	/**
	 * @var integer
	 */
	private $_deuterium;
	
	/**
	 * @param integer $metal
	 * @param integer $crystal
	 * @param integer $deuterium
	 */
	public function __construct($metal, $crystal, $deuterium) {
		
		$this->_metal = $metal;
		$this->_crystal = $crystal;
		$this->_deuterium = $deuterium;
		
	}
	
	/**
	 * @return integer
	 */
	public function getMetal() {
		
		return $this->_metal;
		
	}

	/**
	 * @return integer
	 */
	public function getCrystal() {
		
		return $this->_crystal;
		
	}

	/**
	 * @return integer
	 */
	public function getDeuterium() {
		
		return $this->_deuterium;
		
	}
	
	/**
	 * @return integer
	 */
	public function getTotal() {
		
		return $this->_metal + $this->_crystal + $this->_deuterium;
		
	}
	
	/**
	 * @param OGetIt_Resources $resources
	 */
	public function subtract(OGetIt_Resources $resources) {
		
		$this->_metal -= $resources->getMetal();
		$this->_crystal -= $resources->getCrystal();
		$this->_deuterium -= $resources->getDeuterium();
		
	}
	
	/**
	 * @param OGetIt_Resources $resources
	 */
	public function add(OGetIt_Resources $resources) {
		
		$this->_metal += $resources->getMetal();
		$this->_crystal += $resources->getCrystal();
		$this->_deuterium += $resources->getDeuterium();
		
	}
	
}