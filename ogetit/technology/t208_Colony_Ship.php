<?php

namespace OGetIt\Technology;

class t208_Colony_Ship extends OGetIt_Technology_Combat {

	const TYPE = 208;
	
	const METAL = 10000, CRYSTAL = 20000, DEUTERIUM = 10000;
	
	const ARMOR = 0, SHIELD = 0, WEAPON = 0;
	
	public function __construct() {
		
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON);
		
	}
	
}