<?php

namespace OGetIt\Technology;

class t402_Light_Laser extends OGetIt_Technology {
	
	const METAL = 1500, CRYSTAL = 500, DEUTERIUM = 0;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}