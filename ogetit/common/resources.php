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

class Resources {
	
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
		
		$this->_metal = (int)$metal;
		$this->_crystal = (int)$crystal;
		$this->_deuterium = (int)$deuterium;
		
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
	 * @param Resources $resources
	 * @return Resources
	 */
	public function subtract(Resources $resources) {
		
		$this->_metal -= $resources->getMetal();
		$this->_crystal -= $resources->getCrystal();
		$this->_deuterium -= $resources->getDeuterium();
		
		return $this;
		
	}
	
	/**
	 * @param Resources $resources
	 * @return Resources
	 */
	public function add(Resources $resources) {
		
		$this->_metal += $resources->getMetal();
		$this->_crystal += $resources->getCrystal();
		$this->_deuterium += $resources->getDeuterium();
		
		return $this;
		
	}
	
	/**
	 * @param integer $number
	 * @return Resources
	 */
	public function multiply($number) {
		
		$this->_metal *= $number;
		$this->_crystal *= $number;
		$this->_deuterium *= $number;
		
		return $this;
		
	}
	
}