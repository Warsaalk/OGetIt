<?php

namespace OGetIt\Technology;

class t213_Destroyer extends OGetIt_Technology {
	
	const METAL = 60000, CRYSTAL = 50000, DEUTERIUM = 15000;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}