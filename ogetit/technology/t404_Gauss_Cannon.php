<?php

namespace OGetIt\Technology;

class t404_Gauss_Cannon extends OGetIt_Technology {
	
	const METAL = 20000, CRYSTAL = 15000, DEUTERIUM = 2000;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}