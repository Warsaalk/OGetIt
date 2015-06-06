<?php

namespace OGetIt\Technology\Entity; 

use OGetIt\Technology\OGetIt_Technology_Combat;

class t214_Deathstar extends OGetIt_Technology_Combat {

	const TYPE = 214;
	
	const METAL = 5000000, CRYSTAL = 4000000, DEUTERIUM = 1000000;
	
	const ARMOR = 0, SHIELD = 0, WEAPON = 0;
	
	public function __construct() {
		
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON);
		
	}
	
}