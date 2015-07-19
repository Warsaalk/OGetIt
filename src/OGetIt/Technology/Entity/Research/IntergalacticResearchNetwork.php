<?php
/*
 * Copyright © 2015 Klaas Van Parys
 * 
 * This file is part of OGetIt.
 * 
 * OGetIt is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * OGetIt is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public License
 * along with OGetIt.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace OGetIt\Technology\Entity\Research; 

use OGetIt\Technology\Technology_Economy;

class IntergalacticResearchNetwork extends Technology_Economy {
	
	const TYPE = 123;
	
	const METAL = 0, CRYSTAL = 0, DEUTERIUM = 0;
	
	public function __construct() {
		
		parent::__construct(self::TYPE, self::METAL, self::CRYSTAL, self::DEUTERIUM);
		
	}
	
}