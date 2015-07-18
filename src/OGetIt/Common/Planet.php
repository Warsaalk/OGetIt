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
namespace OGetIt\Common;

class Planet extends Coordinates {

	const	TYPE_PLANET = 1,
			TYPE_MOON = 3;
	
	/**
	 * @var integer
	 */
	private $_type;
	
	/**
	 * @var string
	 */
	private $_name;
	/**
	 * @param string $type
	 * @param string $coordinates
	 */
	public function __construct($type, $coordinates, $name = null) {
		
		parent::__construct($coordinates);
		
		$this->_type = $type;
		$this->_name = $name;
		
	}
	
	/**
	 * @return integer
	 */
	public function getType() {
		
		return $this->_type;
		
	}
	
	/**
	 * @return string
	 */
	public function getName() {
		
		return $this->_name;
		
	}
	
}