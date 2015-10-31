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

class Resources implements \JsonSerializable {
	
	/**
	 * @var integer
	 */
	private $metal;

	/**
	 * @var integer
	 */
	private $crystal;

	/**
	 * @var integer
	 */
	private $deuterium;

	/**
	 * @var integer
	 */	
	private $energy;
	
	/**
	 * @param integer $metal
	 * @param integer $crystal
	 * @param integer $deuterium
	 */
	public function __construct($metal, $crystal, $deuterium, $energy = 0) {
		
		$this->metal = (int)$metal;
		$this->crystal = (int)$crystal;
		$this->deuterium = (int)$deuterium;
		$this->energy = (int)$energy;
		
	}
	
	/**
	 * @return integer
	 */
	public function getMetal() {
		
		return $this->metal;
		
	}

	/**
	 * @return integer
	 */
	public function getCrystal() {
		
		return $this->crystal;
		
	}

	/**
	 * @return integer
	 */
	public function getDeuterium() {
		
		return $this->deuterium;
		
	}
	
	/**
	 * @return integer
	 */
	public function getEnergy() {
		
		return $this->energy;
		
	}
	
	/**
	 * @return integer
	 */
	public function getTotal() {
		
		return $this->metal + $this->crystal + $this->deuterium;
		
	}
	
	/**
	 * @param Resources $resources
	 * @return Resources
	 */
	public function subtract(Resources $resources) {
		
		$this->metal -= $resources->getMetal();
		$this->crystal -= $resources->getCrystal();
		$this->deuterium -= $resources->getDeuterium();
		$this->energy -= $resources->getEnergy();
		
		return $this;
		
	}
	
	/**
	 * @param Resources $resources
	 * @return Resources
	 */
	public function add(Resources $resources) {
		
		$this->metal += $resources->getMetal();
		$this->crystal += $resources->getCrystal();
		$this->deuterium += $resources->getDeuterium();
		$this->energy += $resources->getEnergy();
		
		return $this;
		
	}
	
	/**
	 * @param integer $number
	 * @return Resources
	 */
	public function multiply($number) {
		
		$this->metal *= $number;
		$this->crystal *= $number;
		$this->deuterium *= $number;
		$this->energy *= $number;
		
		return $this;
		
	}
	
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize() {
		return array(
			'metal'	=> $this->metal,
			'crystal' => $this->crystal,
			'deuterium' => $this->deuterium,
			'energy' => $this->energy
		);
	}
	
}