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
namespace OGetIt\Common;

class Player implements \JsonSerializable
{
	const
		CLASS_NONE = 0,
		CLASS_COLLECTOR = 1,
		CLASS_GENERAL = 2,
		CLASS_DISCOVERER = 3;

	/**
	 * @var integer
	 */
	private $id;
	
	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var integer
	 */
	private $class;
	
	/**
	 * @param string $name
	 * @param integer $id
	 */
	public function __construct($name, $id = null, $class = self::CLASS_NONE)
	{
		$this->name = $name;
		$this->id = $id;
		$this->class = $class;
	}
	
	/**
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return int
	 */
	public function getClass()
	{
		return $this->class;
	}
	
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize()
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'class' => $this->class
		];
	}
	
}