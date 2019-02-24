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
namespace OGetIt\XML\ServerData;

use OGetIt\XML\OGameXML;

class ServerData extends OGameXML {
	
	/**
	 * @var string
	 */
	private $name;
	
	/**
	 * @var integer
	 */
	private $number;
	
	/**
	 * @var string
	 */
	private $language;
	
	/**
	 * @var string
	 */
	private $timezone;

	/**
	 * @var string
	 */
	private $timezoneOffset;
	
	/**
	 * @var string
	 */
	private $domain;
	
	/**
	 * @var string
	 */
	private $version;
	
	/**
	 * @var integer
	 */
	private $speed;
	
	/**
	 * @var integer
	 */
	private $speedFleet;
	
	/**
	 * @var integer
	 */
	private $galaxies;
	
	/**
	 * @var integer
	 */
	private $systems;
	
	/**
	 * @var integer
	 */
	private $acs;
	
	/**
	 * @var integer
	 */
	private $rapidFire;
	
	/**
	 * @var integer
	 */
	private $defToTF;
	
	/**
	 * @var float
	 */
	private $debrisFactor;

	/**
	 * @var float
	 */
	private $debrisFactorDef;
	
	/**
	 * @var float
	 */
	private $repairFactor;
	
	/**
	 * @var integer
	 */
	private $newbieProtectionLimit;
	
	/**
	 * @var integer
	 */
	private $newbieProtectionHigh;
	
	/**
	 * @var integer
	 */
	private $topScore;
	
	/**
	 * @var integer
	 */
	private $bonusFields;
	
	/**
	 * @var integer
	 */
	private $donutGalaxy;
	
	/**
	 * @var integer
	 */
	private $donutSystem;

	/**
	 * @var integer
	 */
	private $wfEnabled;

	/**
	 * @var integer
	 */
	private $wfMinimumRessLost;

	/**
	 * @var integer
	 */
	private $wfMinimumLossPercentage;

	/**
	 * @var integer
	 */
	private $wfBasicPercentageRepairable;

	/**
	 * @var float
	 */
	private $globalDeuteriumSaveFactor;

	/**
	 * @var integer
	 */
	private $bashlimit;

	/**
	 * @var integer
	 */
	private $probeCargo;

	/**
	 * @var integer
	 */
	private $researchDurationDivisor;

	/**
	 * @var integer
	 */
	private $darkMatterNewAcount;

	/**
	 * @var integer
	 */
	private $cargoHyperspaceTechMultiplier;

	/**
	 * @param \SimpleXMLElement $data
	 * @return \OGetIt\XML\ServerData\ServerData
	 */
	public static function loadXMLData(\SimpleXMLElement $data) {
				
		return new self(
			$data->name->__toString()?: NULL,
			$data->number->__toString(),
			$data->language->__toString(),
			$data->timezone->__toString(),
			$data->timezoneOffset->__toString(),
			$data->domain->__toString(),
			$data->version->__toString(),
			$data->speed->__toString(),
			$data->speedFleet->__toString(),
			$data->galaxies->__toString(),
			$data->systems->__toString(),
			$data->acs->__toString(),
			$data->rapidFire->__toString(),
			$data->defToTF->__toString(),
			$data->debrisFactor->__toString(),
			$data->debrisFactorDef->__toString(),
			$data->repairFactor->__toString(),
			$data->newbieProtectionLimit->__toString(),
			$data->newbieProtectionHigh->__toString(),
			$data->topScore->__toString(),
			$data->bonusFields->__toString(),
			$data->donutGalaxy->__toString(),
			$data->donutSystem->__toString(),
			$data->wfEnabled->__toString(),
			$data->wfMinimumRessLost->__toString(),
			$data->wfMinimumLossPercentage->__toString(),
			$data->wfBasicPercentageRepairable->__toString(),
			$data->globalDeuteriumSaveFactor->__toString(),
			$data->bashlimit->__toString(),
			$data->probeCargo->__toString(),
			$data->researchDurationDivisor->__toString(),
			$data->darkMatterNewAcount->__toString(),
			$data->cargoHyperspaceTechMultiplier->__toString()
		);
		
	}

	/**
	 * @param string $name
	 * @param integer $number
	 * @param string $language
	 * @param string $timezone
	 * @param string $timezoneOffset
	 * @param string $domain
	 * @param string $version
	 * @param integer $speed
	 * @param integer $speedFleet
	 * @param integer $galaxies
	 * @param integer $systems
	 * @param integer $acs
	 * @param integer $rapidFire
	 * @param integer $defToTF
	 * @param float $debrisFactor
	 * @param float $debrisFactorDef
	 * @param float $repairFactor
	 * @param integer $newbieProtectionLimit
	 * @param integer $newbieProtectionHigh
	 * @param integer $topScore
	 * @param integer $bonusFields
	 * @param integer $donutGalaxy
	 * @param integer $donutSystem
	 * @param integer $wfEnabled
	 * @param integer $wfMinimumRessLost
	 * @param integer $wfMinimumLossPercentage
	 * @param integer $wfBasicPercentageRepairable
	 * @param float $globalDeuteriumSaveFactor
	 * @param integer $bashlimit
	 * @param integer $probeCargo
	 * @param integer $researchDurationDivisor
	 * @param integer $darkMatterNewAcount
	 * @param integer $cargoHyperspaceTechMultiplier
	 */
	public function __construct($name, $number, $language, $timezone, $timezoneOffset, $domain, $version, $speed, $speedFleet, $galaxies, $systems, $acs, $rapidFire, $defToTF, $debrisFactor, $debrisFactorDef, $repairFactor, $newbieProtectionLimit, $newbieProtectionHigh, $topScore, $bonusFields, $donutGalaxy, $donutSystem, $wfEnabled, $wfMinimumRessLost, $wfMinimumLossPercentage, $wfBasicPercentageRepairable, $globalDeuteriumSaveFactor, $bashlimit, $probeCargo, $researchDurationDivisor, $darkMatterNewAcount, $cargoHyperspaceTechMultiplier)
	{
		$this->name = $name;
		$this->number = $number;
		$this->language = $language;
		$this->timezone = $timezone;
		$this->timezoneOffset = $timezoneOffset;
		$this->domain = $domain;
		$this->version = $version;
		$this->speed = $speed;
		$this->speedFleet = $speedFleet;
		$this->galaxies = $galaxies;
		$this->systems = $systems;
		$this->acs = $acs;
		$this->rapidFire = $rapidFire;
		$this->defToTF = $defToTF;
		$this->debrisFactor = $debrisFactor;
		$this->debrisFactorDef = $debrisFactorDef;
		$this->repairFactor = $repairFactor;
		$this->newbieProtectionLimit = $newbieProtectionLimit;
		$this->newbieProtectionHigh = $newbieProtectionHigh;
		$this->topScore = $topScore;
		$this->bonusFields = $bonusFields;
		$this->donutGalaxy = $donutGalaxy;
		$this->donutSystem = $donutSystem;
		$this->wfEnabled = $wfEnabled;
		$this->wfMinimumRessLost = $wfMinimumRessLost;
		$this->wfMinimumLossPercentage = $wfMinimumLossPercentage;
		$this->wfBasicPercentageRepairable = $wfBasicPercentageRepairable;
		$this->globalDeuteriumSaveFactor = $globalDeuteriumSaveFactor;
		$this->bashlimit = $bashlimit;
		$this->probeCargo = $probeCargo;
		$this->researchDurationDivisor = $researchDurationDivisor;
		$this->darkMatterNewAcount = $darkMatterNewAcount;
		$this->cargoHyperspaceTechMultiplier = $cargoHyperspaceTechMultiplier;
	}

	/**
	 * @return string
	 */
	public function getName() { 
		
		return $this->name; 
	
	}
	
	/**
	 * @return integer
	 */
	public function getNumber() { 
		
		return $this->number; 

	}
	
	/**
	 * @return string
	 */
	public function getLanguage() { 
		
		return $this->language; 
	
	}
	
	/**
	 * @return string
	 */
	public function getTimezone() { 
		
		return $this->timezone; 
	
	}
	
	/**
	 * @return string
	 */
	public function getDomain() { 
		
		return $this->domain; 
	
	}
	
	/**
	 * @return string
	 */
	public function getVersion() { 
		
		return $this->version; 
	
	}
	
	/**
	 * @return integer
	 */
	public function getSpeed() { 
		
		return $this->speed; 
	
	}
	
	/**
	 * @return integer
	 */
	public function getSpeedFleet() { 
		
		return $this->speedFleet; 
	
	}
	
	/**
	 * @return integer
	 */
	public function getGalaxies() { 
		
		return $this->galaxies; 
	
	}
	
	/**
	 * @return integer
	 */
	public function getSystems() { 
		
		return $this->systems; 
	
	}
	
	/**
	 * @return integer
	 */
	public function getAcs() { 
		
		return $this->acs; 
	
	}
	
	/**
	 * @return integer
	 */
	public function getRapidFire() { 
		
		return $this->rapidFire; 
	
	}
	
	/**
	 * @return integer
	 */
	public function getDefToTF() { 
		
		return $this->defToTF; 
	
	}
	
	/**
	 * @return float
	 */
	public function getDebrisFactor() { 
		
		return $this->debrisFactor; 
	
	}

	/**
	 * @return float
	 */
	public function getDebrisFactorDef() {

		return $this->debrisFactorDef;

	}
	
	/**
	 * @return float
	 */
	public function getRepairFactor() { 
		
		return $this->repairFactor; 
	
	}
	
	/**
	 * @return integer
	 */
	public function getNewbieProtectionLimit() { 
		
		return $this->newbieProtectionLimit; 
	
	}
	
	/**
	 * @return integer
	 */
	public function getNewbieProtectionHigh() { 
		
		return $this->newbieProtectionHigh; 
	
	}
	
	/**
	 * @return integer
	 */
	public function getTopScore() { 
		
		return $this->topScore; 
	
	}
	
	/**
	 * @return integer
	 */
	public function getBonusFields() { 
		
		return $this->bonusFields; 
	
	}
	
	/**
	 * @return integer
	 */
	public function getDonutGalaxy() { 
		
		return $this->donutGalaxy; 
	
	}
	
	/**
	 * @return integer
	 */
	public function getDonutSystem() { 
		
		return $this->donutSystem; 
	
	}

	/**
	 * @return int
	 */
	public function getWfEnabled()
	{
		return $this->wfEnabled;
	}

	/**
	 * @return int
	 */
	public function getWfBasicPercentageRepairable()
	{
		return $this->wfBasicPercentageRepairable;
	}

	/**
	 * @return int
	 */
	public function getWfMinimumLossPercentage()
	{
		return $this->wfMinimumLossPercentage;
	}

	/**
	 * @return int
	 */
	public function getWfMinimumRessLost()
	{
		return $this->wfMinimumRessLost;
	}

	/**
	 * @return float
	 */
	public function getGlobalDeuteriumSaveFactor()
	{
		return $this->globalDeuteriumSaveFactor;
	}

	/**
	 * @return int
	 */
	public function getBashlimit()
	{
		return $this->bashlimit;
	}

	/**
	 * @return int
	 */
	public function getProbeCargo()
	{
		return $this->probeCargo;
	}

	/**
	 * @return int
	 */
	public function getResearchDurationDivisor()
	{
		return $this->researchDurationDivisor;
	}

	/**
	 * @return int
	 */
	public function getDarkMatterNewAcount()
	{
		return $this->darkMatterNewAcount;
	}

	/**
	 * @return int
	 */
	public function getCargoHyperspaceTechMultiplier()
	{
		return $this->cargoHyperspaceTechMultiplier;
	}
	
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize() {
		return array(
			'name' => $this->name,
			'number' => $this->number,
			'language' => $this->language,
			'timezone' => $this->timezone,
			'timezone_offset' => $this->timezoneOffset,
			'domain' => $this->domain,
			'version' => $this->version,
			'speed' => $this->speed,
			'speed_fleet' => $this->speedFleet,
			'galaxies' => $this->galaxies,
			'systems' => $this->systems,
			'acs' => $this->acs,
			'rapid_fire' => $this->rapidFire,
			'def_to_tF' => $this->defToTF,
			'debris_factor' => $this->debrisFactor,
			'debris_factor_def' => $this->debrisFactorDef,
			'repair_factor' => $this->repairFactor,
			'newbie_protection_limit' => $this->newbieProtectionLimit,
			'newbie_protection_high' => $this->newbieProtectionHigh,
			'top_score' => $this->topScore,
			'bonus_fields' => $this->bonusFields,
			'donut_galaxy' => $this->donutGalaxy,
			'donut_system' => $this->donutSystem,
			'wf_enabled' => $this->wfEnabled,
			'wf_min_res_lost' => $this->wfMinimumRessLost,
			'wf_min_loss_percent' => $this->wfMinimumLossPercentage,
			'wf_basic_percent_repairable' => $this->wfBasicPercentageRepairable,
			'global_deuterium_save_factor' => $this->globalDeuteriumSaveFactor,
			'bash_limit' => $this->bashlimit,
			'probe_cargo' => $this->probeCargo,
			'research_duration_divisor' => $this->researchDurationDivisor,
			'dark_matter_new_acount' => $this->darkMatterNewAcount,
			'cargo_hyperspace_tech_multiplier' => $this->cargoHyperspaceTechMultiplier
		);
	}
	
}