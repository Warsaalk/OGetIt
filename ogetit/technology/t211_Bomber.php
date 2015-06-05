<?php

namespace OGetIt\Technology;

class t211_Bomber extends OGetIt_Technology {
	
	const METAL = 50000, CRYSTAL = 25000, DEUTERIUM = 15000;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}