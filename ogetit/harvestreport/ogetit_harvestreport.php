<?php
namespace OGetIt\HarvestReport;

use OGetIt\Common\OGetIt_Resources;
use OGetIt\Common\OGetIt_DebrisField;

class OGetIt_HarvestReport {

	/**
	 * @var string
	 */
	private $_id;

	/**
	 * @var OGetIt_DebrisField
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
	 * @return OGetIt_CombatReport
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
		$this->_resources = new OGetIt_Resources($metal, $crystal, 0);
		$this->_time = $time;
		$this->_timestamp = $timestamp;
		$this->_recycler_capacity = (int)$recycler_capacity;
		$this->_recycler_count = (int)$recycler_count;
		
		$this->_debris_field = new OGetIt_DebrisField($coordinates, $metal_floating, $crystal_floating);
		
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
	 * @return OGetIt_Resources
	 */
	public function getResources() {
		
		return $this->_resources;
		
	}
	
	/**
	 * @return OGetIt_DebrisField
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