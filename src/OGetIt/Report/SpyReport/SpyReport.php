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
namespace OGetIt\Report\SpyReport;

use OGetIt\Common\Resources;
use OGetIt\Common\Player;
use OGetIt\Common\Planet;
use OGetIt\Report\ReportPlayer;
use OGetIt\Technology\TechnologyFactory;
use OGetIt\Technology\State\StateCombat;
use OGetIt\Technology\State\StateEconomy;
use OGetIt\Common\OGetIt\Common;
use OGetIt\Report\Report;

class SpyReport extends Report {
	
	/**
	 * @var integer
	 */
	private $_activity;
	
	/**
	 * @var ReportPlayer
	 */
	private $_attacker;

	/**
	 * @var SpiedPlayer
	 */
	private $_defender;

	/**
	 * @var integer
	 */
	private $_loot_percentage;

	/**
	 * @var integer
	 */
	private $_spy_fail_chance;

	/**
	 * @var integer
	 */
	private $_total_defense_count;

	/**
	 * @var integer
	 */
	private $_total_ship_count;
	
	/**
	 * @param string $api_data
	 * @return CombatReport
	 */
	public static function createSpyReport($api_data) {
			
		$generic = $api_data['generic'];
		$details = $api_data['details'];
	
		$spyreport = new self(
			$generic['sr_id'],
			$generic['activity'],
			$generic['attacker_name'],
			$generic['attacker_planet_coordinates'],
			$generic['attacker_planet_name'],
			$generic['attacker_planet_type'],
			$generic['defender_name'],
			$generic['defender_planet_coordinates'],
			$generic['defender_planet_name'],
			$generic['defender_planet_type'],
			$generic['event_time'],
			$generic['event_timestamp'],
			$generic['loot_percentage'],
			$generic['spy_fail_chance'],
			$generic['total_defense_count'],
			$generic['total_ship_count']				
		);
		
		if (isset($details['resources'])) {
			$spyreport->getDefender()->setResources(new Resources($details['resources']['metal'], $details['resources']['crystal'], $details['resources']['deuterium']));
		}
						
		if ($generic['failed_buildings'] === false) {
			if (isset($details['buildings'])) {
				foreach ($details['buildings'] as $state) {
					$buildingState = new StateEconomy(TechnologyFactory::create($state['building_type']), $state['level']);
					$spyreport->getDefender()->addBuilding($buildingState);
				}
			}
		}

		if ($generic['failed_research'] === false) {
			if (isset($details['research'])) {
				foreach ($details['research'] as $state) {
					$researchState = new StateEconomy(TechnologyFactory::create($state['research_type']), $state['level']);
					$spyreport->getDefender()->addResearch($researchState);
				}
			}
		}
		
		if ($generic['failed_ships'] === false) {
			if (isset($details['ships'])) {
				foreach ($details['ships'] as $state) {
					$shipState = new StateCombat(TechnologyFactory::create($state['ship_type']), $state['count']);
					$spyreport->getDefender()->addShip($shipState);
				}
			}
		}
		
		if ($generic['failed_defense'] === false) {
			if (isset($details['defense'])) {
				foreach ($details['defense'] as $state) {
					$defenceState = new StateCombat(TechnologyFactory::create($state['defense_type']), $state['count']);
					$spyreport->getDefender()->addDefence($defenceState);
				}
			}
		}
			
		return $spyreport;
	
	}
	
	/**
	 * @param string $id
	 * @param integer $activity
	 * @param string $attacker_name
	 * @param string $attacker_planet_coordinates
	 * @param string $attacker_planet_name
	 * @param integer $attacker_planet_type
	 * @param string $defender_name
	 * @param string $defender_planet_coordinates
	 * @param string $defender_planet_name
	 * @param integer $defender_planet_type
	 * @param string $event_time
	 * @param integer $event_timestamp
	 * @param integer $loot_percentage
	 * @param integer $spy_fail_chance
	 * @param integer $total_defense_count
	 * @param integer $total_ship_count
	 */
	public function __construct($id, $activity, $attacker_name, $attacker_planet_coordinates, $attacker_planet_name, $attacker_planet_type, $defender_name, $defender_planet_coordinates, $defender_planet_name, $defender_planet_type, $time, $timestamp, $loot_percentage, $spy_fail_chance, $total_defense_count, $total_ship_count) {
		
		parent::__construct($id, $time, $timestamp);

		$this->_activity = $activity;
		
		$this->_attacker = new ReportPlayer($attacker_name);
		$this->_attacker->setPlanet(new Planet($attacker_planet_type, $attacker_planet_coordinates, $attacker_planet_name));
		
		$this->_defender = new SpiedPlayer($defender_name);
		$this->_defender->setPlanet(new Planet($defender_planet_type, $defender_planet_coordinates, $defender_planet_name));
		
		$this->_loot_percentage = $loot_percentage;
		$this->_spy_fail_chance = $spy_fail_chance;
		$this->_total_defense_count = $total_defense_count;
		$this->_total_ship_count = $total_ship_count;
		
	}
	
	/**
	 * @return integer
	 */
	public function getActivity() {
		
		return $this->_activity;
		
	}
	
	/**
	 * @return ReportPlayer
	 */
	public function getAttacker() {
		
		return $this->_attacker;
		
	}
	
	/**
	 * @return SpiedPlayer
	 */
	public function getDefender() {
		
		return $this->_defender;
		
	}

	/**
	 * @return integer
	 */
	public function getLootPercentage() {
		
		return $this->_loot_percentage;
		
	}
	
	/**
	 * @return integer
	 */
	public function getSpyFailChance() {
		
		return $this->_spy_fail_chance;
		
	}
	
	/**
	 * @return integer
	 */
	public function getTotalDefenseCount() {
		
		return $this->_total_defense_count;
		
	}
	
	/**
	 * @return integer
	 */
	public function getTotalShipCount() {
		
		return $this->_total_ship_count;
		
	}
	
}