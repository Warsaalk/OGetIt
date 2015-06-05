<?php

namespace OGetIt\Technology;

class t203_Large_Cargo extends OGetIt_Technology {
	
	const METAL = 6000, CRYSTAL = 6000, DEUTERIUM = 0;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}