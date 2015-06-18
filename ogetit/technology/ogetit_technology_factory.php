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
namespace OGetIt\Technology;

use OGetIt\Technology\Entity\t202_Small_Cargo;
use OGetIt\Technology\Entity\t203_Large_Cargo;
use OGetIt\Technology\Entity\t408_Large_Shield_Dome;
use OGetIt\Technology\Entity\t407_Small_Shield_Dome;
use OGetIt\Technology\Entity\t406_Plasma_Turret;
use OGetIt\Technology\Entity\t405_Ion_Cannon;
use OGetIt\Technology\Entity\t404_Gauss_Cannon;
use OGetIt\Technology\Entity\t403_Heavy_Laser;
use OGetIt\Technology\Entity\t402_Light_Laser;
use OGetIt\Technology\Entity\t401_Rocket_Launcher;
use OGetIt\Technology\Entity\t215_Battlecruiser;
use OGetIt\Technology\Entity\t214_Deathstar;
use OGetIt\Technology\Entity\t213_Destroyer;
use OGetIt\Technology\Entity\t212_Solar_Satellite;
use OGetIt\Technology\Entity\t211_Bomber;
use OGetIt\Technology\Entity\t210_Espionage_Probe;
use OGetIt\Technology\Entity\t209_Recycler;
use OGetIt\Technology\Entity\t208_Colony_Ship;
use OGetIt\Technology\Entity\t207_Battleship;
use OGetIt\Technology\Entity\t206_Cruiser;
use OGetIt\Technology\Entity\t205_Heavy_Fighter;
use OGetIt\Technology\Entity\t204_Light_Fighter;

class OGetIt_Technology_Factory {
	
	/**
	 * @param integer $type
	 * @return OGetIt_Technology
	 */
	public static function create($type) {
		
		$technology = null;
		
		switch ($type) {
			//Ships			
			case 202: $technology = new t202_Small_Cargo(); break;
			case 203: $technology = new t203_Large_Cargo(); break;
			case 204: $technology = new t204_Light_Fighter(); break;
			case 205: $technology = new t205_Heavy_Fighter(); break;
			case 206: $technology = new t206_Cruiser(); break;
			case 207: $technology = new t207_Battleship(); break;
			case 208: $technology = new t208_Colony_Ship(); break;
			case 209: $technology = new t209_Recycler(); break;
			case 210: $technology = new t210_Espionage_Probe(); break;
			case 211: $technology = new t211_Bomber(); break;
			case 212: $technology = new t212_Solar_Satellite(); break;
			case 213: $technology = new t213_Destroyer(); break;
			case 214: $technology = new t214_Deathstar(); break;
			case 215: $technology = new t215_Battlecruiser(); break;
			
			//Defence
			case 401: $technology = new t401_Rocket_Launcher(); break;
			case 402: $technology = new t402_Light_Laser(); break;
			case 403: $technology = new t403_Heavy_Laser(); break;
			case 404: $technology = new t404_Gauss_Cannon(); break;
			case 405: $technology = new t405_Ion_Cannon(); break;
			case 406: $technology = new t406_Plasma_Turret(); break;
			case 407: $technology = new t407_Small_Shield_Dome(); break;
			case 408: $technology = new t408_Large_Shield_Dome(); break;
			
			/*
			 * default: throws new OGetIt_Exception('test');
			 */
		}	
		
		return $technology;
		
	} 
	
}