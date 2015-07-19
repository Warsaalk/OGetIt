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
namespace OGetIt\Report\HarvestReport;

use OGetIt\Common\Resources;
use OGetIt\Common\DebrisField;

class HarvestReport {

	/**
	 * @var string
	 */
	private $_id;

	/**
	 * @var DebrisField
	 */
	private $_debris_field;
	
	/**
	 * @var string
	 */
	private $_time;
	
	/**
	 * @var integer
	 */
	private $_timestamp;
	
	/**
	 * @var integer
	 */
	private $_recycler_capacity;
	
	/**
	 * @var integer
	 */
	private $_recycler_count;
	
	/**
	 * @param string $api_data
	 * @return CombatReport
	 */
	public static function createHarvestReport($api_data) {
	
		$generic = $api_data['generic'];
	
		$harvestreport = new self(
				$generic['rr_id'],
				$generic['coordinates'],
				$generic['metal_retrieved'],
				$generic['metal_in_debris_field'],
				$generic['crystal_retrieved'],
				$generic['crystal_in_debris_field'],
				$generic['event_time'],
				$generic['event_timestamp'],
				$generic['recycler_capacity'],
				$generic['recycler_count']
		);
	
		return $harvestreport;
	
	}
	
	/**
	 * @param string $id
	 * @param string $coordinates
	 * @param integer $metal
	 * @param integer $metal_floating
	 * @param integer $crystal
	 * @param integer $crystal_floating
	 * @param string $time
	 * @param integer $timestamp
	 * @param integer $recycler_capacity
	 * @param integer $recycler_count
	 */
	public function __construct($id, $coordinates, $metal, $metal_floating, $crystal, $crystal_floating, $time, $timestamp, $recycler_capacity, $recycler_count) {
		
		$this->_id = $id;
		$this->_resources = new Resources($metal, $crystal, 0);
		$this->_time = $time;
		$this->_timestamp = $timestamp;
		$this->_recycler_capacity = (int)$recycler_capacity;
		$this->_recycler_count = (int)$recycler_count;
		
		$this->_debris_field = new DebrisField($coordinates, $metal_floating, $crystal_floating);
		
	}
	
	/**
	 * @return string
	 */
	public function getId() {
		
		return $this->_id;
		
	}
	
	/**
	 * @return integer
	 */
	public function getMetal() {
		
		return $this->_resources->getMetal();
		
	}

	/**
	 * @return integer
	 */
	public function getCrystal() {
		
		return $this->_resources->getCrystal();
		
	}
	
	/**
	 * @return Resources
	 */
	public function getResources() {
		
		return $this->_resources;
		
	}
	
	/**
	 * @return DebrisField
	 */
	public function getDebrisField() {
		
		return $this->_debris_field;
		
	}
	
	/**
	 * @return string
	 */
	public function getTime() {
		
		return $this->_time;
		
	}
	
	/**
	 * @return integer
	 */
	public function getTimestamp() {
		
		return $this->_timestamp;
		
	}
	
	/**
	 * @return integer
	 */
	public function getRecyclerCapacity() {
		
		return $this->_recycler_capacity;
		
	}
	
	/**
	 * @return integer
	 */
	public function getRecyclerCount() {
		
		return $this->_recycler_count;
		
	}
	
}