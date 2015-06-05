<?php

namespace OGetIt\Technology;

class t202_Small_Cargo extends OGetIt_Technology {
	
	const METAL = 2000, CRYSTAL = 2000, DEUTERIUM = 0;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}