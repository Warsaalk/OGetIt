<?php

namespace OGetIt\Technology;

class t407_Small_Shield_Dome extends OGetIt_Technology_Combat {

	const TYPE = 407;
	
	const METAL = 10000, CRYSTAL = 10000, DEUTERIUM = 0;
	
	const ARMOR = 0, SHIELD = 0, WEAPON = 0;
	
	public function __construct() {
		
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON);
		
	}
	
}