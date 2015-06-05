<?php

namespace OGetIt\Technology;

class t207_Battleship extends OGetIt_Technology {
	
	const METAL = 45000, CRYSTAL = 15000, DEUTERIUM = 0;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}