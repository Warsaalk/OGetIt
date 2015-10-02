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
namespace OGetIt\Report\CombatReport;

class CombatMoon {

	/**
	 * @var integer
	 */
	private $moon_chance;

	/**
	 * @var boolean
	 */
	private $moon_created;

	/**
	 * @var integer
	 */
	private $moon_size;
	
	/**
	 * @var boolean
	 */
	private $moon_exists;
	
	/**
	 * @param integer $moon_chance
	 * @param boolean $moon_created
	 * @param boolean $moon_exists
	 * @param integer $moon_size
	 */
	public function __construct($moon_chance, $moon_created, $moon_exists, $moon_size) {
		
		$this->moon_chance = $moon_chance;
		$this->moon_created = $moon_created;
		$this->moon_size = $moon_size;
		$this->moon_exists = $moon_exists;
		
	}
	
	/**
	 * @return integer
	 */
	public function getMoonChance() {
		
		return $this->moon_chance;
		
	}
	
	/**
	 * @return boolean
	 */
	public function getMoonCreated() {
		
		return $this->moon_created;
		
	}
	
	/**
	 * @return integer
	 */
	public function getMoonSize() {
		
		return $this->moon_size;
		
	}
	
	/**
	 * @return boolean
	 */
	public function getMoonExists() {
		
		return $this->moon_exists;
		
	}
	
	
}