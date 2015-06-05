<?php

namespace OGetIt\Technology;

class t206_Cruiser extends OGetIt_Technology {
	
	const METAL = 20000, CRYSTAL = 7000, DEUTERIUM = 2000;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}