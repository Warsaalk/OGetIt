<?php

namespace OGetIt\Technology;

class t405_Ion_Cannon extends OGetIt_Technology {
	
	const METAL = 2000, CRYSTAL = 6000, DEUTERIUM = 0;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}