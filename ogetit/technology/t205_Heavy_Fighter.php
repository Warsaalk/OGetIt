<?php

namespace OGetIt\Technology;

class t205_Heavy_Fighter extends OGetIt_Technology_Combat {

	const TYPE = 205;
	
	const METAL = 6000, CRYSTAL = 4000, DEUTERIUM = 0;
	
	const ARMOR = 0, SHIELD = 0, WEAPON = 0;
	
	public function __construct() {
		
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON);
		
	}
	
}