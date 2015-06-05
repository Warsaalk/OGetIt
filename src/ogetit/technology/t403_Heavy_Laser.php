<?php

namespace OGetIt\Technology;

class t403_Heavy_Laser extends OGetIt_Technology {
	
	const METAL = 6000, CRYSTAL = 2000, DEUTERIUM = 0;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}