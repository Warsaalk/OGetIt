<?php

namespace OGetIt\Technology;

class t401_Rocket_Launcher extends OGetIt_Technology {
	
	const METAL = 2000, CRYSTAL = 0, DEUTERIUM = 0;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}