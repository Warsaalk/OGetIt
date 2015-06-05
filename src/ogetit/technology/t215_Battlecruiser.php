<?php

namespace OGetIt\Technology;

class t215_Battlecruiser extends OGetIt_Technology {
	
	const METAL = 30000, CRYSTAL = 40000, DEUTERIUM = 15000;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}