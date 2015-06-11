<?php

namespace OGetIt\CombatReport;

class OGetIt_CombatRound_Stats {
		
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
	 * @return OGetIt_CombatRound_Stats
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