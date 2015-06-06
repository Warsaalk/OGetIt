<?php

namespace OGetIt\Technology\Entity; 

use OGetIt\Technology\OGetIt_Technology_Combat;

class t212_Solar_Satellite extends OGetIt_Technology_Combat {

	const TYPE = 212;
	
	const METAL = 0, CRYSTAL = 2000, DEUTERIUM = 500;
	
	const ARMOR = 0, SHIELD = 0, WEAPON = 0;
	
	public function __construct() {
		
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON);
		
	}
	
}