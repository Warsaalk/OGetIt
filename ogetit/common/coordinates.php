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

class Coordinates {
	
	/**
	 * @var string
	 */
	private $_coordinates;
	
	/**
	 * @var integer
	 */
	private $_galaxy;

	/**
	 * @var integer
	 */
	private $_system;

	/**
	 * @var integer
	 */
	private $_position;
	
	/**
	 * @param string $type
	 * @param string $coordinates
	 */
	public function __construct($coordinates) {
		
		$this->_coordinates = $coordinates;
		
		$coordinatesObject = self::parseCoordinates($coordinates);
		
		$this->_galaxy = $coordinatesObject->galaxy;
		$this->_system = $coordinatesObject->system;
		$this->_position = $coordinatesObject->position;
		
	}
	
	/**
	 * @param string $coordinates
	 * @return \stdClass
	 */
	public static function parseCoordinates($coordinates) {
		
		$coordinatesArray = explode(':', $coordinates);
		$coordinatesObject = new \stdClass();
		$coordinatesObject->galaxy = (int)$coordinatesArray[0];
		$coordinatesObject->system = (int)$coordinatesArray[1];
		$coordinatesObject->position = (int)$coordinatesArray[2];
		
		return $coordinatesObject;
		
	}

	/**
	 * @return string
	 */
	public function getCoordinates() {
		
		return $this->_coordinates;
		
	}

	/**
	 * @return integer
	 */
	public function getGalaxy() {
		
		return $this->_galaxy;
		
	}

	/**
	 * @return integer
	 */
	public function getSystem() {
		
		return $this->_system;
		
	}

	/**
	 * @return integer
	 */
	public function getPosition() {
		
		return $this->_position;
		
	}
	
}