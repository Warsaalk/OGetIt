<?php
namespace OGetIt\Technology;

class OGetIt_Technology_Factory {
	
	/**
	 * @param integer $type
	 * @return OGetIt_Technology
	 */
	public static function create($type) {
		
		$technology = null;
		
		switch ($type) {
			//Ships
			case 202: $technology = new t202_Small_Cargo();
			case 203: $technology = new t203_Large_Cargo();
			case 204: $technology = new t204_Light_Fighter();
			case 205: $technology = new t205_Heavy_Fighter();
			case 206: $technology = new t206_Cruiser();
			case 207: $technology = new t207_Battleship();
			case 208: $technology = new t208_Colony_Ship();
			case 209: $technology = new t209_Recycler();
			case 210: $technology = new t210_Espionage_Probe();
			case 211: $technology = new t211_Bomber();
			case 212: $technology = new t212_Solar_Satellite();
			case 213: $technology = new t213_Destroyer();
			case 214: $technology = new t214_Deathstar();
			case 215: $technology = new t215_Battlecruiser();
			
			//Defence
			case 401: $technology = new t401_Rocket_Launcher();
			case 402: $technology = new t402_Light_Laser();
			case 403: $technology = new t403_Heavy_Laser();
			case 404: $technology = new t404_Gauss_Cannon();
			case 405: $technology = new t405_Ion_Cannon();
			case 406: $technology = new t406_Plasma_Turret();
			case 407: $technology = new t407_Small_Shield_Dome();
			case 408: $technology = new t408_Large_Shield_Dome();
			
			/*
			 * default: throws new OGetIt_Exception('test');
			 */
		}	
		
		return $technology;
		
	} 
	
}