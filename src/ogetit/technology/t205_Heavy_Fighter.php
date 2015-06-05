<?php

namespace OGetIt\Technology;

class t205_Heavy_Fighter extends OGetIt_Technology {
	
	const METAL = 6000, CRYSTAL = 4000, DEUTERIUM = 0;
	
	public function __construct() {
		
		parent::__construct(self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}