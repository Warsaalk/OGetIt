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

class Player {
	
	/**
	 * @var integer
	 */
	private $_id;
	
	/**
	 * @var string
	 */
	private $_name;
	
	/**
	 * @param string $name
	 * @param integer $id
	 */
	public function __construct($name, $id = null) {
		
		$this->_name = $name;
		$this->_id = $id;
		
	}
	
	/**
	 * @return integer
	 */
	public function getId() {
		
		return $this->_id;
		
	}
	
	/**
	 * @return string
	 */
	public function getName() {
		
		return $this->_name;
		
	}
	
}