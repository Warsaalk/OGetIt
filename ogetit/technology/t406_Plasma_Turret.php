<?php

namespace OGetIt\Technology;

class t406_Plasma_Turret extends OGetIt_Technology {
	
	const METAL = 50000, CRYSTAL = 50000, DEUTERIUM = 30000;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}