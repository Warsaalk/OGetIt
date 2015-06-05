<?php

namespace OGetIt\Technology;

class t402_Light_Laser extends OGetIt_Technology_Combat {

	const TYPE = 402;
	
	const METAL = 1500, CRYSTAL = 500, DEUTERIUM = 0;
	
	const ARMOR = 0, SHIELD = 0, WEAPON = 0;
	
	public function __construct() {
		
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON);
		
	}
	
}