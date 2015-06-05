<?php

namespace OGetIt\Technology;

class t408_Large_Shield_Dome extends OGetIt_Technology {
	
	const METAL = 50000, CRYSTAL = 50000, DEUTERIUM = 0;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}