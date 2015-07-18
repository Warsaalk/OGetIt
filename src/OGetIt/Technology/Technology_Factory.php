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

use OGetIt\Technology\Entity\Ship\SmallCargo;
use OGetIt\Technology\Entity\Ship\LargeCargo;
use OGetIt\Technology\Entity\Defence\LargeShieldDome;
use OGetIt\Technology\Entity\Defence\SmallShieldDome;
use OGetIt\Technology\Entity\Defence\PlasmaTurret;
use OGetIt\Technology\Entity\Defence\IonCannon;
use OGetIt\Technology\Entity\Defence\GaussCannon;
use OGetIt\Technology\Entity\Defence\HeavyLaser;
use OGetIt\Technology\Entity\Defence\LightLaser;
use OGetIt\Technology\Entity\Defence\RocketLauncher;
use OGetIt\Technology\Entity\Ship\Battlecruiser;
use OGetIt\Technology\Entity\Ship\Deathstar;
use OGetIt\Technology\Entity\Ship\Destroyer;
use OGetIt\Technology\Entity\Ship\SolarSatellite;
use OGetIt\Technology\Entity\Ship\Bomber;
use OGetIt\Technology\Entity\Ship\EspionageProbe;
use OGetIt\Technology\Entity\Ship\Recycler;
use OGetIt\Technology\Entity\Ship\ColonyShip;
use OGetIt\Technology\Entity\Ship\Battleship;
use OGetIt\Technology\Entity\Ship\Cruiser;
use OGetIt\Technology\Entity\Ship\HeavyFighter;
use OGetIt\Technology\Entity\Ship\LightFighter;

class Technology_Factory {
	
	/**
	 * @param integer $type
	 * @return Technology
	 */
	public static function create($type) {
		
		$technology = null;
		
		switch ($type) {
			//Ships			
			case 202: $technology = new SmallCargo(); break;
			case 203: $technology = new LargeCargo(); break;
			case 204: $technology = new LightFighter(); break;
			case 205: $technology = new HeavyFighter(); break;
			case 206: $technology = new Cruiser(); break;
			case 207: $technology = new Battleship(); break;
			case 208: $technology = new ColonyShip(); break;
			case 209: $technology = new Recycler(); break;
			case 210: $technology = new EspionageProbe(); break;
			case 211: $technology = new Bomber(); break;
			case 212: $technology = new SolarSatellite(); break;
			case 213: $technology = new Destroyer(); break;
			case 214: $technology = new Deathstar(); break;
			case 215: $technology = new Battlecruiser(); break;
			
			//Defence
			case 401: $technology = new RocketLauncher(); break;
			case 402: $technology = new LightLaser(); break;
			case 403: $technology = new HeavyLaser(); break;
			case 404: $technology = new GaussCannon(); break;
			case 405: $technology = new IonCannon(); break;
			case 406: $technology = new PlasmaTurret(); break;
			case 407: $technology = new SmallShieldDome(); break;
			case 408: $technology = new LargeShieldDome(); break;
			
			/*
			 * default: throws new Exception('test');
			 */
		}	
		
		return $technology;
		
	} 
	
}