<?php

namespace OGetIt\Technology;

class t202_Small_Cargo extends OGetIt_Technology_Combat {
	
	const TYPE = 202;
	
	const METAL = 2000, CRYSTAL = 2000, DEUTERIUM = 0;
	
	const ARMOR = 0, SHIELD = 0, WEAPON = 0;
	
	public function __construct() {
		
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON);
		
	}
	
}