<?php

namespace OGetIt\Technology;

class t209_Recycler extends OGetIt_Technology_Combat {

	const TYPE = 209;
	
	const METAL = 10000, CRYSTAL = 6000, DEUTERIUM = 2000;
	
	const ARMOR = 0, SHIELD = 0, WEAPON = 0;
	
	public function __construct() {
		
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON);
		
	}
	
}