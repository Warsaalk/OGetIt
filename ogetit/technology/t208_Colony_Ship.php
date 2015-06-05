<?php

namespace OGetIt\Technology;

class t208_Colony_Ship extends OGetIt_Technology {
	
	const METAL = 10000, CRYSTAL = 20000, DEUTERIUM = 10000;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}