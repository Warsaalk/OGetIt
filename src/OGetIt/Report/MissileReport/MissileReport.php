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
namespace OGetIt\Report\MissileReport;

use OGetIt\Report\Report;
use OGetIt\Report\ReportPlayer;
use OGetIt\Common\Player;
use OGetIt\Common\Planet;
use OGetIt\Technology\TechnologyFactory;
use OGetIt\Technology\State\StateCombatWithLosses;

class MissileReport extends Report {
	
	/**
	 * @var MissilePlayer
	 */
	private $attacker;
	
	/**
	 * @var integer
	 */
	private $attacker_lost_missiles;

	/**
	 * @var MissilePlayer
	 */
	private $defender;
	
	/**
	 * @var integer
	 */
	private $defender_lost_missiles;
	
	/**
	 * @param string $api_data
	 * @return CombatReport
	 */
	public static function createMissileReport($api_data) {
			
		$generic = $api_data['generic'];
		$details = $api_data['details'];
	
		$missilereport = new self(
			$generic['mr_id'],
			$generic['event_time'],
			$generic['event_timestamp'],
			$generic['attacker_name'],
			$generic['attacker_planet_coordinates'],
			$generic['attacker_planet_name'],
			$generic['attacker_planet_type'],
			$generic['defender_name'],
			$generic['defender_planet_coordinates'],
			$generic['defender_planet_name'],
			$generic['defender_planet_type'],
			$generic['missiles_lost_attacker'],
			$generic['missiles_lost_defender']
		);
			
		if (isset($details['defense'])) {
			$defence_data = array();
			
			foreach ($details['defense'] as $data) {
				$defence_data[$data['defense_type']] = array(
						'count' => $data['count']
				);
			}
			
			if (isset($details['defense_destroyed'])) {
				foreach ($details['defense_destroyed'] as $data) {
					$defence_data[$data['defense_type']]['lost'] = (int)$data['count'];
				}
			}
			
			$missilereport->loadDefenderDefence($defence_data);			
		}
		
		return $missilereport;
	
	}
	
	/**
	 * @param string $id
	 */
	public function __construct($id, $time, $timestamp, $attacker_name, $attacker_planet_coordinates, $attacker_planet_name, $attacker_planet_type, $defender_name, $defender_planet_coordinates, $defender_planet_name, $defender_planet_type, $missiles_lost_attacker, $missiles_lost_defender) {
		
		parent::__construct($id, $time, $timestamp);
		
		$this->attacker = new ReportPlayer($attacker_name);
		$this->attacker->setPlanet(new Planet($attacker_planet_type, $attacker_planet_coordinates, $attacker_planet_name));
		$this->attacker_lost_missiles = $missiles_lost_attacker;
		
		$this->defender = new MissilePlayer($defender_name);
		$this->defender->setPlanet(new Planet($defender_planet_type, $defender_planet_coordinates, $defender_planet_name));
		$this->defender_lost_missiles = $missiles_lost_defender;
		
	}
	
	/**
	 * @param array $details
	 */
	private function loadDefenderDefence($details) {
		
		foreach ($details as $type => $techData) {
				
			$lost = isset($techData['lost']) ? $techData['lost'] : 0;
			$state = new StateCombatWithLosses(TechnologyFactory::create($type), $techData['count'], $lost);
			$this->defender->addLostDefence($state);
				
		}
		
	}

	/**
	 * @return integer
	 */
	public function getAttackerLostMissiles() {
		
		return $this->attacker_lost_missiles;
		
	}
	
	/**
	 * @return integer
	 */
	public function getDefenderLostMissiles() {
		
		return $this->defender_lost_missiles;
		
	}
	
}