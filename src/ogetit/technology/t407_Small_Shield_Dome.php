<?php

namespace OGetIt\Technology;

class t407_Small_Shield_Dome extends OGetIt_Technology {
	
	const METAL = 10000, CRYSTAL = 10000, DEUTERIUM = 0;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}