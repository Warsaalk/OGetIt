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

abstract class Report implements \JsonSerializable {

	/**
	 * @var string
	 */
	private $id;
	
	/**
	 * @var string
	 */
	private $time;
	
	/**
	 * @var integer
	 */
	private $timestamp;
	
	/**
	 * @param string $id
	 */
	public function __construct($id, $time, $timestamp) {
		
		$this->id = $id;
		$this->time = $time;
		$this->timestamp = $timestamp;
		
	}
	
	/**
	 * @return string
	 */
	public function getId() {
		
		return $this->id;
		
	}
	
	/**
	 * @return string
	 */
	public function getTime() {
		
		return $this->time;
		
	}
	
	/**
	 * @return integer
	 */
	public function getTimestamp() {
		
		return $this->timestamp;
		
	}
	
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize() {
		return array(
			'id' => $this->id,
			'time' => $this->time,
			'timestamp' => $this->timestamp
		);
	}
	
}