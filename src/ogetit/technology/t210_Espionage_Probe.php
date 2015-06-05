<?php

namespace OGetIt\Technology;

class t210_Espionage_Probe extends OGetIt_Technology {
	
	const METAL = 0, CRYSTAL = 1000, DEUTERIUM = 0;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}