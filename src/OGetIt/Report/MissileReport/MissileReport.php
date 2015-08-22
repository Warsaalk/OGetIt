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

class MissileReport extends Report {
	
	/**
	 * @param string $api_data
	 * @return CombatReport
	 */
	public static function createMissileReport($api_data) {
			
		$generic = $api_data['generic'];
	
		$missilereport = new self(
			$generic['mr_id'],
			$generic['event_time'],
			$generic['event_timestamp']
		);
			
		return $missilereport;
	
	}
	
	/**
	 * @param string $id
	 */
	public function __construct($id, $time, $timestamp) {
		
		parent::__construct($id, $time, $timestamp);
		
	}
	
}