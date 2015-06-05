<?php

namespace OGetIt\Technology;

class t401_Rocket_Launcher extends OGetIt_Technology_Combat {

	const TYPE = 401;
	
	const METAL = 2000, CRYSTAL = 0, DEUTERIUM = 0;
	
	const ARMOR = 0, SHIELD = 0, WEAPON = 0;
	
	public function __construct() {
		
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON);
		
	}
	
}