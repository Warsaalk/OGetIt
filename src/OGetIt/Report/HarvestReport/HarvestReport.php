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
namespace OGetIt\Report\HarvestReport;

use OGetIt\Common\Resources;
use OGetIt\Common\DebrisField;
use OGetIt\Report\Report;

class HarvestReport extends Report implements \JsonSerializable {

	/**
	 * @var DebrisField
	 */
	private $debris_field;
	
	/**
	 * @var integer
	 */
	private $recycler_capacity;
	
	/**
	 * @var integer
	 */
	private $recycler_count;
	
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
		
		parent::__construct($id, $time, $timestamp);
		
		$this->resources = new Resources($metal, $crystal, 0);
		$this->recycler_capacity = (int)$recycler_capacity;
		$this->recycler_count = (int)$recycler_count;
		
		$this->debris_field = new DebrisField($coordinates, $metal_floating, $crystal_floating);
		
	}
	
	/**
	 * @return integer
	 */
	public function getMetal() {
		
		return $this->resources->getMetal();
		
	}

	/**
	 * @return integer
	 */
	public function getCrystal() {
		
		return $this->resources->getCrystal();
		
	}
	
	/**
	 * @return Resources
	 */
	public function getResources() {
		
		return $this->resources;
		
	}
	
	/**
	 * @return DebrisField
	 */
	public function getDebrisField() {
		
		return $this->debris_field;
		
	}
	
	/**
	 * @return integer
	 */
	public function getRecyclerCapacity() {
		
		return $this->recycler_capacity;
		
	}
	
	/**
	 * @return integer
	 */
	public function getRecyclerCount() {
		
		return $this->recycler_count;
		
	}
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize() {
		return array_merge(array(
			'debris_field' => $this->debris_field,
			'recycler_capacity' => $this->recycler_capacity,
			'recycler_count' => $this->recycler_count
		), parent::jsonSerialize());
	}
	
}