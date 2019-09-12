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

class ServerData extends OGameXML
{
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
	 * @var integer
	 */
	private $marketplaceEnabled;

	/**
	 * @var float
	 */
	private $marketplaceBasicTradeRatioMetal;

	/**
	 * @var float
	 */
	private $marketplaceBasicTradeRatioCrystal;

	/**
	 * @var float
	 */
	private $marketplaceBasicTradeRatioDeuterium;

	/**
	 * @var float
	 */
	private $marketplacePriceRangeLower;

	/**
	 * @var float
	 */
	private $marketplacePriceRangeUpper;

	/**
	 * @var float
	 */
	private $marketplaceTaxNormalUser;

	/**
	 * @var float
	 */
	private $marketplaceTaxAdmiral;

	/**
	 * @var float
	 */
	private $marketplaceTaxCancelOffer;

	/**
	 * @var float
	 */
	private $marketplaceTaxNotSold;

	/**
	 * @var integer
	 */
	private $marketplaceOfferTimeout;

	/**
	 * @var integer
	 */
	private $characterClassesEnabled;

	/**
	 * @var float
	 */
	private $minerBonusResourceProduction;

	/**
	 * @var float
	 */
	private $minerBonusFasterTradingShips;

	/**
	 * @var float
	 */
	private $minerBonusIncreasedCargoCapacityForTradingShips;

	/**
	 * @var integer
	 */
	private $minerBonusAdditionalFleetSlots;

	/**
	 * @var float
	 */
	private $resourceBuggyProductionBoost;

	/**
	 * @var float
	 */
	private $resourceBuggyMaxProductionBoost;

	/**
	 * @var float
	 */
	private $resourceBuggyEnergyConsumptionPerUnit;

	/**
	 * @var float
	 */
	private $warriorBonusFasterCombatShips;

	/**
	 * @var float
	 */
	private $warriorBonusFasterRecyclers;

	/**
	 * @var float
	 */
	private $warriorBonusRecyclerFuelConsumption;

	/**
	 * @var float
	 */
	private $combatDebrisFieldLimit;

	/**
	 * @var float
	 */
	private $explorerBonusIncreasedResearchSpeed;

	/**
	 * @var float
	 */
	private $explorerBonusIncreasedExpeditionOutcome;

	/**
	 * @var float
	 */
	private $explorerBonusLargerPlanets;

	/**
	 * @var float
	 */
	private $explorerUnitItemsPerDay;

	/**
	 * @param \SimpleXMLElement $data
	 * @return \OGetIt\XML\ServerData\ServerData
	 */
	public static function loadXMLData(\SimpleXMLElement $data)
	{
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
			$data->cargoHyperspaceTechMultiplier->__toString(),
			$data->marketplaceEnabled->__toString(),
			$data->marketplaceBasicTradeRatioMetal->__toString(),
			$data->marketplaceBasicTradeRatioCrystal->__toString(),
			$data->marketplaceBasicTradeRatioDeuterium->__toString(),
			$data->marketplacePriceRangeLower->__toString(),
			$data->marketplacePriceRangeUpper->__toString(),
			$data->marketplaceTaxNormalUser->__toString(),
			$data->marketplaceTaxAdmiral->__toString(),
			$data->marketplaceTaxCancelOffer->__toString(),
			$data->marketplaceTaxNotSold->__toString(),
			$data->marketplaceOfferTimeout->__toString(),
			$data->characterClassesEnabled->__toString(),
			$data->minerBonusResourceProduction->__toString(),
			$data->minerBonusFasterTradingShips->__toString(),
			$data->minerBonusIncreasedCargoCapacityForTradingShips->__toString(),
			$data->minerBonusAdditionalFleetSlots->__toString(),
			$data->resourceBuggyProductionBoost->__toString(),
			$data->resourceBuggyMaxProductionBoost->__toString(),
			$data->resourceBuggyEnergyConsumptionPerUnit->__toString(),
			$data->warriorBonusFasterCombatShips->__toString(),
			$data->warriorBonusFasterRecyclers->__toString(),
			$data->warriorBonusRecyclerFuelConsumption->__toString(),
			$data->combatDebrisFieldLimit->__toString(),
			$data->explorerBonusIncreasedResearchSpeed->__toString(),
			$data->explorerBonusIncreasedExpeditionOutcome->__toString(),
			$data->explorerBonusLargerPlanets->__toString(),
			$data->explorerUnitItemsPerDay->__toString()
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
	 * @param integer $marketplaceEnabled,
	 * @param float $marketplaceBasicTradeRatioMetal,
	 * @param float $marketplaceBasicTradeRatioCrystal,
	 * @param float $marketplaceBasicTradeRatioDeuterium,
	 * @param float $marketplacePriceRangeLower,
	 * @param float $marketplacePriceRangeUpper,
	 * @param float $marketplaceTaxNormalUser,
	 * @param float $marketplaceTaxAdmiral,
	 * @param float $marketplaceTaxCancelOffer,
	 * @param float $marketplaceTaxNotSold,
	 * @param integer $marketplaceOfferTimeout,
	 * @param integer $characterClassesEnabled,
	 * @param float $minerBonusResourceProduction,
	 * @param float $minerBonusFasterTradingShips,
	 * @param float $minerBonusIncreasedCargoCapacityForTradingShips,
	 * @param integer $minerBonusAdditionalFleetSlots,
	 * @param float $resourceBuggyProductionBoost,
	 * @param float $resourceBuggyMaxProductionBoost,
	 * @param float $resourceBuggyEnergyConsumptionPerUnit,
	 * @param float $warriorBonusFasterCombatShips,
	 * @param float $warriorBonusFasterRecyclers,
	 * @param float $warriorBonusRecyclerFuelConsumption,
	 * @param float $combatDebrisFieldLimit,
	 * @param float $explorerBonusIncreasedResearchSpeed,
	 * @param float $explorerBonusIncreasedExpeditionOutcome,
	 * @param float $explorerBonusLargerPlanets,
	 * @param float $explorerUnitItemsPerDay
	 */
	public function __construct(
		$name,
		$number,
		$language,
		$timezone,
		$timezoneOffset,
		$domain,
		$version,
		$speed,
		$speedFleet,
		$galaxies,
		$systems,
		$acs,
		$rapidFire,
		$defToTF,
		$debrisFactor,
		$debrisFactorDef,
		$repairFactor,
		$newbieProtectionLimit,
		$newbieProtectionHigh,
		$topScore,
		$bonusFields,
		$donutGalaxy,
		$donutSystem,
		$wfEnabled,
		$wfMinimumRessLost,
		$wfMinimumLossPercentage,
		$wfBasicPercentageRepairable,
		$globalDeuteriumSaveFactor,
		$bashlimit,
		$probeCargo,
		$researchDurationDivisor,
		$darkMatterNewAcount,
		$cargoHyperspaceTechMultiplier,
		$marketplaceEnabled,
		$marketplaceBasicTradeRatioMetal,
		$marketplaceBasicTradeRatioCrystal,
		$marketplaceBasicTradeRatioDeuterium,
		$marketplacePriceRangeLower,
		$marketplacePriceRangeUpper,
		$marketplaceTaxNormalUser,
		$marketplaceTaxAdmiral,
		$marketplaceTaxCancelOffer,
		$marketplaceTaxNotSold,
		$marketplaceOfferTimeout,
		$characterClassesEnabled,
		$minerBonusResourceProduction,
		$minerBonusFasterTradingShips,
		$minerBonusIncreasedCargoCapacityForTradingShips,
		$minerBonusAdditionalFleetSlots,
		$resourceBuggyProductionBoost,
		$resourceBuggyMaxProductionBoost,
		$resourceBuggyEnergyConsumptionPerUnit,
		$warriorBonusFasterCombatShips,
		$warriorBonusFasterRecyclers,
		$warriorBonusRecyclerFuelConsumption,
		$combatDebrisFieldLimit,
		$explorerBonusIncreasedResearchSpeed,
		$explorerBonusIncreasedExpeditionOutcome,
		$explorerBonusLargerPlanets,
		$explorerUnitItemsPerDay
	)
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
		$this->marketplaceEnabled = $marketplaceEnabled;
		$this->marketplaceBasicTradeRatioMetal = $marketplaceBasicTradeRatioMetal;
		$this->marketplaceBasicTradeRatioCrystal = $marketplaceBasicTradeRatioCrystal;
		$this->marketplaceBasicTradeRatioDeuterium = $marketplaceBasicTradeRatioDeuterium;
		$this->marketplacePriceRangeLower = $marketplacePriceRangeLower;
		$this->marketplacePriceRangeUpper = $marketplacePriceRangeUpper;
		$this->marketplaceTaxNormalUser = $marketplaceTaxNormalUser;
		$this->marketplaceTaxAdmiral = $marketplaceTaxAdmiral;
		$this->marketplaceTaxCancelOffer = $marketplaceTaxCancelOffer;
		$this->marketplaceTaxNotSold = $marketplaceTaxNotSold;
		$this->marketplaceOfferTimeout = $marketplaceOfferTimeout;
		$this->characterClassesEnabled = $characterClassesEnabled;
		$this->minerBonusResourceProduction = $minerBonusResourceProduction;
		$this->minerBonusFasterTradingShips = $minerBonusFasterTradingShips;
		$this->minerBonusIncreasedCargoCapacityForTradingShips = $minerBonusIncreasedCargoCapacityForTradingShips;
		$this->minerBonusAdditionalFleetSlots = $minerBonusAdditionalFleetSlots;
		$this->resourceBuggyProductionBoost = $resourceBuggyProductionBoost;
		$this->resourceBuggyMaxProductionBoost = $resourceBuggyMaxProductionBoost;
		$this->resourceBuggyEnergyConsumptionPerUnit = $resourceBuggyEnergyConsumptionPerUnit;
		$this->warriorBonusFasterCombatShips = $warriorBonusFasterCombatShips;
		$this->warriorBonusFasterRecyclers = $warriorBonusFasterRecyclers;
		$this->warriorBonusRecyclerFuelConsumption = $warriorBonusRecyclerFuelConsumption;
		$this->combatDebrisFieldLimit = $combatDebrisFieldLimit;
		$this->explorerBonusIncreasedResearchSpeed = $explorerBonusIncreasedResearchSpeed;
		$this->explorerBonusIncreasedExpeditionOutcome = $explorerBonusIncreasedExpeditionOutcome;
		$this->explorerBonusLargerPlanets = $explorerBonusLargerPlanets;
		$this->explorerUnitItemsPerDay = $explorerUnitItemsPerDay;
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

	/**
	 * @return int
	 */
	public function getMarketplaceEnabled()
	{
		return $this->marketplaceEnabled;
	}

	/**
	 * @return float
	 */
	public function getMarketplaceBasicTradeRatioMetal()
	{
		return $this->marketplaceBasicTradeRatioMetal;
	}

	/**
	 * @return float
	 */
	public function getMarketplaceBasicTradeRatioCrystal()
	{
		return $this->marketplaceBasicTradeRatioCrystal;
	}

	/**
	 * @return float
	 */
	public function getMarketplaceBasicTradeRatioDeuterium()
	{
		return $this->marketplaceBasicTradeRatioDeuterium;
	}

	/**
	 * @return float
	 */
	public function getMarketplacePriceRangeLower()
	{
		return $this->marketplacePriceRangeLower;
	}

	/**
	 * @return float
	 */
	public function getMarketplacePriceRangeUpper()
	{
		return $this->marketplacePriceRangeUpper;
	}

	/**
	 * @return float
	 */
	public function getMarketplaceTaxNormalUser()
	{
		return $this->marketplaceTaxNormalUser;
	}

	/**
	 * @return float
	 */
	public function getMarketplaceTaxAdmiral()
	{
		return $this->marketplaceTaxAdmiral;
	}

	/**
	 * @return float
	 */
	public function getMarketplaceTaxCancelOffer()
	{
		return $this->marketplaceTaxCancelOffer;
	}

	/**
	 * @return float
	 */
	public function getMarketplaceTaxNotSold()
	{
		return $this->marketplaceTaxNotSold;
	}

	/**
	 * @return int
	 */
	public function getMarketplaceOfferTimeout()
	{
		return $this->marketplaceOfferTimeout;
	}

	/**
	 * @return int
	 */
	public function getCharacterClassesEnabled()
	{
		return $this->characterClassesEnabled;
	}

	/**
	 * @return float
	 */
	public function getMinerBonusResourceProduction()
	{
		return $this->minerBonusResourceProduction;
	}

	/**
	 * @return float
	 */
	public function getMinerBonusFasterTradingShips()
	{
		return $this->minerBonusFasterTradingShips;
	}

	/**
	 * @return float
	 */
	public function getMinerBonusIncreasedCargoCapacityForTradingShips()
	{
		return $this->minerBonusIncreasedCargoCapacityForTradingShips;
	}

	/**
	 * @return int
	 */
	public function getMinerBonusAdditionalFleetSlots()
	{
		return $this->minerBonusAdditionalFleetSlots;
	}

	/**
	 * @return float
	 */
	public function getResourceBuggyProductionBoost()
	{
		return $this->resourceBuggyProductionBoost;
	}

	/**
	 * @return float
	 */
	public function getResourceBuggyMaxProductionBoost()
	{
		return $this->resourceBuggyMaxProductionBoost;
	}

	/**
	 * @return float
	 */
	public function getResourceBuggyEnergyConsumptionPerUnit()
	{
		return $this->resourceBuggyEnergyConsumptionPerUnit;
	}

	/**
	 * @return float
	 */
	public function getWarriorBonusFasterCombatShips()
	{
		return $this->warriorBonusFasterCombatShips;
	}

	/**
	 * @return float
	 */
	public function getWarriorBonusFasterRecyclers()
	{
		return $this->warriorBonusFasterRecyclers;
	}

	/**
	 * @return float
	 */
	public function getWarriorBonusRecyclerFuelConsumption()
	{
		return $this->warriorBonusRecyclerFuelConsumption;
	}

	/**
	 * @return float
	 */
	public function getCombatDebrisFieldLimit()
	{
		return $this->combatDebrisFieldLimit;
	}

	/**
	 * @return float
	 */
	public function getExplorerBonusIncreasedResearchSpeed()
	{
		return $this->explorerBonusIncreasedResearchSpeed;
	}

	/**
	 * @return float
	 */
	public function getExplorerBonusIncreasedExpeditionOutcome()
	{
		return $this->explorerBonusIncreasedExpeditionOutcome;
	}

	/**
	 * @return float
	 */
	public function getExplorerBonusLargerPlanets()
	{
		return $this->explorerBonusLargerPlanets;
	}

	/**
	 * @return float
	 */
	public function getExplorerUnitItemsPerDay()
	{
		return $this->explorerUnitItemsPerDay;
	}
	
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize()
	{
		return [
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
			'cargo_hyperspace_tech_multiplier' => $this->cargoHyperspaceTechMultiplier,
			'marketplaceEnabled' => $this->marketplaceEnabled,
			'marketplaceBasicTradeRatioMetal' => $this->marketplaceBasicTradeRatioMetal,
			'marketplaceBasicTradeRatioCrystal' => $this->marketplaceBasicTradeRatioCrystal,
			'marketplaceBasicTradeRatioDeuterium' => $this->marketplaceBasicTradeRatioDeuterium,
			'marketplacePriceRangeLower' => $this->marketplacePriceRangeLower,
			'marketplacePriceRangeUpper' => $this->marketplacePriceRangeUpper,
			'marketplaceTaxNormalUser' => $this->marketplaceTaxNormalUser,
			'marketplaceTaxAdmiral' => $this->marketplaceTaxAdmiral,
			'marketplaceTaxCancelOffer' => $this->marketplaceTaxCancelOffer,
			'marketplaceTaxNotSold' => $this->marketplaceTaxNotSold,
			'marketplaceOfferTimeout' => $this->marketplaceOfferTimeout,
			'characterClassesEnabled' => $this->characterClassesEnabled,
			'minerBonusResourceProduction' => $this->minerBonusResourceProduction,
			'minerBonusFasterTradingShips' => $this->minerBonusFasterTradingShips,
			'minerBonusIncreasedCargoCapacityForTradingShips' => $this->minerBonusIncreasedCargoCapacityForTradingShips,
			'minerBonusAdditionalFleetSlots' => $this->minerBonusAdditionalFleetSlots,
			'resourceBuggyProductionBoost' => $this->resourceBuggyProductionBoost,
			'resourceBuggyMaxProductionBoost' => $this->resourceBuggyMaxProductionBoost,
			'resourceBuggyEnergyConsumptionPerUnit' => $this->resourceBuggyEnergyConsumptionPerUnit,
			'warriorBonusFasterCombatShips' => $this->warriorBonusFasterCombatShips,
			'warriorBonusFasterRecyclers' => $this->warriorBonusFasterRecyclers,
			'warriorBonusRecyclerFuelConsumption' => $this->warriorBonusRecyclerFuelConsumption,
			'combatDebrisFieldLimit' => $this->combatDebrisFieldLimit,
			'explorerBonusIncreasedResearchSpeed' => $this->explorerBonusIncreasedResearchSpeed,
			'explorerBonusIncreasedExpeditionOutcome' => $this->explorerBonusIncreasedExpeditionOutcome,
			'explorerBonusLargerPlanets' => $this->explorerBonusLargerPlanets,
			'explorerUnitItemsPerDay' => $this->explorerUnitItemsPerDay
		];
	}
}