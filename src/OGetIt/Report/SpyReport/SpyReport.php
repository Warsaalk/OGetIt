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
namespace OGetIt\Report\SpyReport;

use OGetIt\Common\Resources;
use OGetIt\Common\Player;
use OGetIt\Common\Planet;
use OGetIt\Common\Alliance;
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
	private $activity;
	
	/**
	 * @var ReportPlayer
	 */
	private $attacker;

	/**
	 * @var SpiedPlayer
	 */
	private $defender;

	/**
	 * @var integer
	 */
	private $loot_percentage;

	/**
	 * @var integer
	 */
	private $spy_fail_chance;

	/**
	 * @var integer
	 */
	private $total_defense_count;

	/**
	 * @var integer
	 */
	private $total_ship_count;
	
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
			$generic['attacker_user_id'],
			$generic['attacker_character_class_id'],
			$generic['attacker_planet_coordinates'],
			$generic['attacker_planet_name'],
			$generic['attacker_planet_type'],
			$generic['attacker_alliance_name'],
			$generic['attacker_alliance_tag'],
			$generic['defender_name'],
			$generic['defender_user_id'],
			$generic['defender_character_class_id'],
			$generic['defender_planet_coordinates'],
			$generic['defender_planet_name'],
			$generic['defender_planet_type'],
			$generic['defender_alliance_name'],
			$generic['defender_alliance_tag'],
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
	 * SpyReport constructor.
	 * @param $id
	 * @param $activity
	 * @param $attacker_name
	 * @param $attacker_user_id
	 * @param $attacker_character_class_id
	 * @param $attacker_planet_coordinates
	 * @param $attacker_planet_name
	 * @param $attacker_planet_type
	 * @param $attacker_alliance_name
	 * @param $attacker_alliance_tag
	 * @param $defender_name
	 * @param $defender_user_id
	 * @param $defender_character_class_id
	 * @param $defender_planet_coordinates
	 * @param $defender_planet_name
	 * @param $defender_planet_type
	 * @param $defender_alliance_name
	 * @param $defender_alliance_tag
	 * @param $time
	 * @param $timestamp
	 * @param $loot_percentage
	 * @param $spy_fail_chance
	 * @param $total_defense_count
	 * @param $total_ship_count
	 */
	public function __construct($id, $activity, $attacker_name, $attacker_user_id, $attacker_character_class_id, $attacker_planet_coordinates, $attacker_planet_name, $attacker_planet_type, $attacker_alliance_name, $attacker_alliance_tag, $defender_name, $defender_user_id, $defender_character_class_id, $defender_planet_coordinates, $defender_planet_name, $defender_planet_type, $defender_alliance_name, $defender_alliance_tag, $time, $timestamp, $loot_percentage, $spy_fail_chance, $total_defense_count, $total_ship_count) {
		
		parent::__construct($id, $time, $timestamp);

		$this->activity = $activity;
		
		$this->attacker = new ReportPlayer($attacker_name, $attacker_user_id, $attacker_character_class_id);
		$this->attacker->setPlanet(new Planet($attacker_planet_type, $attacker_planet_coordinates, $attacker_planet_name));
		$this->attacker->setAlliance(new Alliance($attacker_alliance_tag, $attacker_alliance_name));
		
		$this->defender = new SpiedPlayer($defender_name, $defender_user_id, $defender_character_class_id);
		$this->defender->setPlanet(new Planet($defender_planet_type, $defender_planet_coordinates, $defender_planet_name));
		$this->defender->setAlliance(new Alliance($defender_alliance_tag, $defender_alliance_name));
		
		$this->loot_percentage = $loot_percentage;
		$this->spy_fail_chance = $spy_fail_chance;
		$this->total_defense_count = $total_defense_count;
		$this->total_ship_count = $total_ship_count;
		
	}
	
	/**
	 * @return integer
	 */
	public function getActivity() {
		
		return $this->activity;
		
	}
	
	/**
	 * @return ReportPlayer
	 */
	public function getAttacker() {
		
		return $this->attacker;
		
	}
	
	/**
	 * @return SpiedPlayer
	 */
	public function getDefender() {
		
		return $this->defender;
		
	}

	/**
	 * @return integer
	 */
	public function getLootPercentage() {
		
		return $this->loot_percentage;
		
	}
	
	/**
	 * @return integer
	 */
	public function getSpyFailChance() {
		
		return $this->spy_fail_chance;
		
	}
	
	/**
	 * @return integer
	 */
	public function getTotalDefenseCount() {
		
		return $this->total_defense_count;
		
	}
	
	/**
	 * @return integer
	 */
	public function getTotalShipCount() {
		
		return $this->total_ship_count;
		
	}
	
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize() {
		return array_merge(array(
			'activity' => $this->activity,
			'attacker' => $this->attacker,
			'defender' => $this->defender,
			'loot_percentage' => $this->loot_percentage,
			'spy_fail_chance' => $this->spy_fail_chance,
			'total_defense_count' => $this->total_defense_count,
			'total_ship_count' => $this->total_ship_count
		), parent::jsonSerialize());
	}
	
}