<?php

namespace OGetIt\Technology;

class t204_Light_Fighter extends OGetIt_Technology_Combat {

	const TYPE = 204;
	
	const METAL = 3000, CRYSTAL = 1000, DEUTERIUM = 0;
	
	const ARMOR = 0, SHIELD = 0, WEAPON = 0;
	
	public function __construct() {
		
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON);
		
	}
	
}