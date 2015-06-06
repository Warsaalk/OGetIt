<?php

namespace OGetIt\Technology\Entity; 

use OGetIt\Technology\OGetIt_Technology_Combat;

class t213_Destroyer extends OGetIt_Technology_Combat {

	const TYPE = 213;
	
	const METAL = 60000, CRYSTAL = 50000, DEUTERIUM = 15000;
	
	const ARMOR = 0, SHIELD = 0, WEAPON = 0;
	
	public function __construct() {
		
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON);
		
	}
	
}