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
namespace OGetIt\Report;

abstract class Report {

	/**
	 * @var string
	 */
	private $_id;
	
	/**
	 * @var string
	 */
	private $_time;
	
	/**
	 * @var integer
	 */
	private $_timestamp;
	
	/**
	 * @param string $id
	 */
	public function __construct($id, $time, $timestamp) {
		
		$this->_id = $id;
		$this->_time = $time;
		$this->_timestamp = $timestamp;
		
	}
	
	/**
	 * @return string
	 */
	public function getId() {
		
		return $this->_id;
		
	}
	
	/**
	 * @return string
	 */
	public function getTime() {
		
		return $this->_time;
		
	}
	
	/**
	 * @return integer
	 */
	public function getTimestamp() {
		
		return $this->_timestamp;
		
	}
	
}