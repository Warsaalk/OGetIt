<?php

namespace OGetIt\Technology;

class t214_Deathstar extends OGetIt_Technology {
	
	const METAL = 5000000, CRYSTAL = 4000000, DEUTERIUM = 1000000;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}