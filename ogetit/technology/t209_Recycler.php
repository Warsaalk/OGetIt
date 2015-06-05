<?php

namespace OGetIt\Technology;

class t209_Recycler extends OGetIt_Technology {
	
	const METAL = 10000, CRYSTAL = 6000, DEUTERIUM = 2000;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}