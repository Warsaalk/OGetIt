<?php

namespace OGetIt\Technology;

class t207_Battleship extends OGetIt_Technology_Combat {

	const TYPE = 207;
	
	const METAL = 45000, CRYSTAL = 15000, DEUTERIUM = 0;
	
	const ARMOR = 0, SHIELD = 0, WEAPON = 0;
	
	public function __construct() {
		
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM, self::ARMOR, self::SHIELD, self::WEAPON);
		
	}
	
}