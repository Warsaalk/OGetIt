<?php
/*
 * OGetIt, a open source PHP library for handling the new OGame API as of version 6.
 * Copyright (C) 2015  Klaas Van Parys
 * 
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
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