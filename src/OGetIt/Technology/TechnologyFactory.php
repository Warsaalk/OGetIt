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
use OGetIt\Technology\Entity\Building\MetalMine;
use OGetIt\Technology\Entity\Building\CrystalMine;
use OGetIt\Technology\Entity\Building\DeuteriumSynthesizer;
use OGetIt\Technology\Entity\Building\SolarPlant;
use OGetIt\Technology\Entity\Building\FusionReactor;
use OGetIt\Technology\Entity\Building\RoboticsFactory;
use OGetIt\Technology\Entity\Building\NaniteFactory;
use OGetIt\Technology\Entity\Building\Shipyard;
use OGetIt\Technology\Entity\Building\MetalStorage;
use OGetIt\Technology\Entity\Building\CrystalStorage;
use OGetIt\Technology\Entity\Building\DeuteriumTank;
use OGetIt\Technology\Entity\Building\ShieldedMetalDen;
use OGetIt\Technology\Entity\Building\UndergroundCrystalDen;
use OGetIt\Technology\Entity\Building\SeabedDeuteriumDen;
use OGetIt\Technology\Entity\Building\ResearchLab;
use OGetIt\Technology\Entity\Building\Terraformer;
use OGetIt\Technology\Entity\Building\AllianceDepot;
use OGetIt\Technology\Entity\Building\LunarBase;
use OGetIt\Technology\Entity\Building\SensorPhalanx;
use OGetIt\Technology\Entity\Building\JumpGate;
use OGetIt\Technology\Entity\Building\MissileSilo;
use OGetIt\Technology\Entity\Research\EspionageTechnology;
use OGetIt\Technology\Entity\Research\ComputerTechnology;
use OGetIt\Technology\Entity\Research\WeaponsTechnology;
use OGetIt\Technology\Entity\Research\ShieldingTechnology;
use OGetIt\Technology\Entity\Research\ArmourTechnology;
use OGetIt\Technology\Entity\Research\EnergyTechnology;
use OGetIt\Technology\Entity\Research\HyperspaceTechnology;
use OGetIt\Technology\Entity\Research\CombustionDrive;
use OGetIt\Technology\Entity\Research\ImpulseDrive;
use OGetIt\Technology\Entity\Research\HyperspaceDrive;
use OGetIt\Technology\Entity\Research\LaserTechnology;
use OGetIt\Technology\Entity\Research\IonTechnology;
use OGetIt\Technology\Entity\Research\PlasmaTechnology;
use OGetIt\Technology\Entity\Research\IntergalacticResearchNetwork;
use OGetIt\Technology\Entity\Research\Astrophysics;
use OGetIt\Technology\Entity\Research\GravitonTechnology;

class TechnologyFactory {
	
	/**
	 * @param integer $type
	 * @return Technology
	 */
	public static function create($type) {
		
		$technology = null;
		
		switch ($type) {
			//Buildings
			case 1: $technology = new MetalMine(); break;
			case 2: $technology = new CrystalMine(); break;
			case 3: $technology = new DeuteriumSynthesizer(); break;
			case 4: $technology = new SolarPlant(); break;
			case 12: $technology = new FusionReactor(); break;
			case 14: $technology = new RoboticsFactory(); break;
			case 15: $technology = new NaniteFactory(); break;
			case 21: $technology = new Shipyard(); break;
			case 22: $technology = new MetalStorage(); break;
			case 23: $technology = new CrystalStorage(); break;
			case 24: $technology = new DeuteriumTank(); break;
			case 25: $technology = new ShieldedMetalDen(); break;
			case 26: $technology = new UndergroundCrystalDen(); break;
			case 27: $technology = new SeabedDeuteriumDen(); break;
			case 31: $technology = new ResearchLab(); break;
			case 33: $technology = new Terraformer(); break;
			case 34: $technology = new AllianceDepot(); break;
			case 41: $technology = new LunarBase(); break;
			case 42: $technology = new SensorPhalanx(); break;
			case 43: $technology = new JumpGate(); break;
			case 44: $technology = new MissileSilo(); break;
			//Research
			case 106: $technology = new EspionageTechnology(); break;
			case 108: $technology = new ComputerTechnology(); break;
			case 109: $technology = new WeaponsTechnology(); break;
			case 110: $technology = new ShieldingTechnology(); break;
			case 111: $technology = new ArmourTechnology(); break;
			case 113: $technology = new EnergyTechnology(); break;
			case 114: $technology = new HyperspaceTechnology(); break;
			case 115: $technology = new CombustionDrive(); break;
			case 117: $technology = new ImpulseDrive(); break;
			case 118: $technology = new HyperspaceDrive(); break;
			case 120: $technology = new LaserTechnology(); break;
			case 121: $technology = new IonTechnology(); break;
			case 122: $technology = new PlasmaTechnology(); break;
			case 123: $technology = new IntergalacticResearchNetwork(); break;
			case 124: $technology = new Astrophysics(); break;
			case 199: $technology = new GravitonTechnology(); break;
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