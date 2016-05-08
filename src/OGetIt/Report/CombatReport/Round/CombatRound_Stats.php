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
namespace OGetIt\Report\CombatReport\Round;

class CombatRound_Stats implements \JsonSerializable {
		
	/**
	 * @var integer
	 */
	private $attacker_hits;

	/**
	 * @var integer
	 */
	private $attacker_absorbed;	
	
	/**
	 * @var integer
	 */
	private $attacker_fullstrength;	
	
	/**
	 * @var integer
	 */
	private $defender_hits;	
	
	/**
	 * @var integer
	 */
	private $defender_absorbed;	
	
	/**
	 * @var integer
	 */
	private $defender_fullstrength;

	/**
	 * @param array $data
	 * @return CombatRound_Stats
	 */
	public static function createInstance($data) {
		
		return new self(
			$data['attacker_hits'], 
			$data['attacker_absorbed'], 
			$data['attacker_fullstrength'], 
			$data['defender_hits'], 
			$data['defender_absorbed'], 
			$data['defender_absorbed'], 
			$data['defender_fullstrength']
		);
		
	}
	
	/**
	 * @param integer $attacker_hits
	 * @param integer $attacker_absorbed
	 * @param integer $attacker_fullstrength
	 * @param integer $defender_hits
	 * @param integer $defender_absorbed
	 * @param integer $defender_absorbed
	 * @param integer $defender_fullstrength
	 */
	public function __construct($attacker_hits, $attacker_absorbed, $attacker_fullstrength, $defender_hits, $defender_absorbed, $defender_fullstrength) {
		
		$this->attacker_hits = $attacker_hits;
		$this->attacker_absorbed = $attacker_absorbed;
		$this->attacker_fullstrength = $attacker_fullstrength;
		
		$this->defender_hits = $defender_hits;
		$this->defender_absorbed = $defender_absorbed;
		$this->defender_fullstrength = $defender_fullstrength;

	}

	/**
	 * @return integer
	 */
	public function getAttackerHits() {
		
		return $this->attacker_hits;
		
	}

	/**
	 * @return integer
	 */
	public function getAttackerAbsorbed() {
		
		return $this->attacker_absorbed;
		
	}

	/**
	 * @return integer
	 */
	public function getAttackerFullStrength() {
		
		return $this->attacker_fullstrength;
		
	}

	/**
	 * @return integer
	 */
	public function getDefenderHits() {
		
		return $this->defender_hits;
		
	}

	/**
	 * @return integer
	 */
	public function getDefenderAbsorbed() {
		
		return $this->defender_absorbed;
		
	}
	
	/**
	 * @return integer
	 */
	public function getDefenderFullStrength() {
		
		return $this->defender_fullstrength;
		
	}
	
	/* (non-PHPdoc)
	 * @see JsonSerializable::jsonSerialize()
	 */
	public function jsonSerialize() {
		return array(
			'attacker_hits' => $this->attacker_hits,
			'attacker_absorbed' => $this->attacker_absorbed,
			'attacker_fullstrength' => $this->attacker_fullstrength,
			'defender_hits' => $this->defender_hits,
			'defender_absorbed' => $this->defender_absorbed,
			'defender_fullstrength' => $this->defender_fullstrength,
		);
	}
		
}