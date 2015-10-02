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
	 * @var integer
	 */	
	private $_energy;
	
	/**
	 * @param integer $metal
	 * @param integer $crystal
	 * @param integer $deuterium
	 */
	public function __construct($metal, $crystal, $deuterium, $energy = 0) {
		
		$this->_metal = (int)$metal;
		$this->_crystal = (int)$crystal;
		$this->_deuterium = (int)$deuterium;
		$this->_energy = (int)$energy;
		
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
	public function getEnergy() {
		
		return $this->_energy;
		
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
		$this->_energy -= $resources->getEnergy();
		
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
		$this->_energy += $resources->getEnergy();
		
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
		$this->_energy *= $number;
		
		return $this;
		
	}
	
}