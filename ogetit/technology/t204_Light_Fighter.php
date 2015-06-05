<?php

namespace OGetIt\Technology;

class t204_Light_Fighter extends OGetIt_Technology {
	
	const METAL = 3000, CRYSTAL = 1000, DEUTERIUM = 0;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}