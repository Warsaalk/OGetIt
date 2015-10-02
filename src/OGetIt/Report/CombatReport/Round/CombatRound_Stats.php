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

class CombatRound_Stats {
		
	/**
	 * @var integer
	 */
	private $_attacker_hits;

	/**
	 * @var integer
	 */
	private $_attacker_absorbed;	
	
	/**
	 * @var integer
	 */
	private $_attacker_fullstrength;	
	
	/**
	 * @var integer
	 */
	private $_defender_hits;	
	
	/**
	 * @var integer
	 */
	private $_defender_absorbed;	
	
	/**
	 * @var integer
	 */
	private $_defender_fullstrength;

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
	public function __construct($attacker_hits, $attacker_absorbed, $attacker_fullstrength, $defender_hits, $defender_absorbed, $defender_absorbed, $defender_fullstrength) {
		
		$this->_attacker_hits = $attacker_hits;
		$this->_attacker_absorbed = $attacker_absorbed;
		$this->_attacker_fullstrength = $attacker_fullstrength;
		
		$this->_defender_hits = $defender_hits;
		$this->_defender_absorbed = $defender_absorbed;
		$this->_defender_fullstrength = $defender_fullstrength;

	}

	/**
	 * @return integer
	 */
	public function getAttackerHits() {
		
		return $this->_attacker_hits;
		
	}

	/**
	 * @return integer
	 */
	public function getAttackerAbsorbed() {
		
		return $this->_attacker_absorbed;
		
	}

	/**
	 * @return integer
	 */
	public function getAttackerFullStrength() {
		
		return $this->_attacker_fullstrength;
		
	}

	/**
	 * @return integer
	 */
	public function getDefenderHits() {
		
		return $this->_defender_hits;
		
	}

	/**
	 * @return integer
	 */
	public function getDefenderAbsorbed() {
		
		return $this->_defender_absorbed;
		
	}
	
	/**
	 * @return integer
	 */
	public function getDefenderFullStrength() {
		
		return $this->_defender_fullstrength;
		
	}
		
}