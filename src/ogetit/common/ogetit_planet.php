<?php

namespace OGetIt\Common;

class OGetIt_Planet {

	const	TYPE_PLANET = 1,
			TYPE_MOON = 3;
	
	/**
	 * @var integer
	 */
	private $_type;
	
	/**
	 * @var string
	 */
	private $_coordinates;
	
	/**
	 * @var string
	 */
	private $_name;
	
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
	public function __construct($type, $coordinates, $name = null) {
		
		$this->_type = $type;
		$this->_coordinates = $coordinates;
		$this->_name = $name;
		
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
	 * @return integer
	 */
	public function getType() {
		
		return $this->_type;
		
	}

	/**
	 * @return string
	 */
	public function getCoordinates() {
		
		return $this->_coordinates;
		
	}
	
	/**
	 * @return string
	 */
	public function getName() {
		
		return $this->_name;
		
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