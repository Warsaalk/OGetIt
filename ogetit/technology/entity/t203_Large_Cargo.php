<?php

namespace OGetIt\Technology\Entity; 

use OGetIt\Technology\OGetIt_Technology_Combat;

class t203_Large_Cargo extends OGetIt_Technology_Combat {

	const TYPE = 203;
	
	const METAL = 6000, CRYSTAL = 6000, DEUTERIUM = 0;
	
	const ARMOR = 0, SHIELD = 0, WEAPON = 0;
	
	public function __construct() {
		
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON);
		
	}
	
}