<?php

namespace OGetIt\Technology;

class t212_Solar_Satellite extends OGetIt_Technology {
	
	const METAL = 0, CRYSTAL = 2000, DEUTERIUM = 500;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}