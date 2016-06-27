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
namespace OGetIt\Technology;

use OGetIt\Common\Resources;

abstract class TechnologyEconomy extends Technology {
	
	/**
	 * @var integer
	 */
	protected $power_base = 2;

	/**
	 * @var integer
	 */
	protected $power_base_metal;

	/**
	 * @var integer
	 */
	protected $power_base_crystal;

	/**
	 * @var integer
	 */
	protected $power_base_deuterium;

	/**
	 * @var integer
	 */
	protected $power_base_energy;
	
	/**
	 * @param integer $type
	 * @param integer $metal
	 * @param integer $crystal
	 * @param integer $deuterium
	 * @param integer $energy
	 */
	protected function __construct($type, $metal, $crystal, $deuterium, $energy = 0) {
		
		parent::__construct($type, $metal, $crystal, $deuterium, $energy);

		if (is_null($this->power_base_metal)) 		$this->power_base_metal = $this->power_base;
		if (is_null($this->power_base_crystal)) 	$this->power_base_crystal = $this->power_base;
		if (is_null($this->power_base_deuterium)) 	$this->power_base_deuterium = $this->power_base;
		if (is_null($this->power_base_energy)) 		$this->power_base_energy = $this->power_base;

	}
	
	/**
	 * @param integer $level
	 * @return Resources
	 */
	public function getCosts($level = 1) {

		$level--;

		return new Resources(
			$this->getResources()->getMetal() * pow($this->power_base_metal, $level),
			$this->getResources()->getCrystal() * pow($this->power_base_crystal, $level),
			$this->getResources()->getDeuterium() * pow($this->power_base_deuterium, $level),
			$this->getResources()->getEnergy() * pow($this->power_base_energy, $level)
		);
		
	}
	
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize() {
		return array_merge(array(
			'power_base' => $this->power_base
		), parent::jsonSerialize());
	}
	
}