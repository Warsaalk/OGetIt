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
namespace OGetIt\Report\SpyReport;

use OGetIt\Common\Resources;
use OGetIt\Technology\TechnologyCombat;
use OGetIt\Technology\TechnologyEconomy;
use OGetIt\Technology\State\StateEconomy;
use OGetIt\Technology\State\StateCombat;

class SpiedPlayer extends SpyPlayer {
		
	/**
	 * @var Resources
	 */
	private $_resources;
	
	/**
	 * @var StateEconomy[]
	 */
	private $_buildings = array();
	
	/**
	 * @var StateEconomy[]
	 */
	private $_research = array();

	/**
	 * @var StateCombat[]
	 */
	private $_ships = array();
	
	/**
	 * @var StateCombat[]
	 */
	private $_defence = array();
	
	/**
	 * @param Resources $resources
	 */
	public function setResources(Resources $resources) {
		
		$this->_resources = $resources;
		
	}
	
	/**
	 * @return Resources
	 */
	public function getResources() {
		
		return $this->_resources;
		
	}
	
	/**
	 * @param StateEconomy $entityState
	 */
	public function addBuilding(StateEconomy $entityState) {
		
		$this->_buildings[$entityState->getTechnology()->getType()] = $entityState;
		
	}
	
	/**
	 * @return StateEconomy[]
	 */
	public function getBuildings() {
		
		return $this->_buildings;
		
	}
	
	/**
	 * @param StateEconomy $entityState
	 */
	public function addResearch(StateEconomy $entityState) {
		
		$this->_research[$entityState->getTechnology()->getType()] = $entityState;
		
	}
	
	/**
	 * @return StateEconomy[]
	 */
	public function getResearch() {
		
		return $this->_research;
		
	}
	
	/**
	 * @param StateCombat $entityState
	 */
	public function addShip(StateCombat $entityState) {
		
		$this->_ships[$entityState->getTechnology()->getType()] = $entityState;
		
	}
	
	/**
	 * @return StateCombat[]
	 */
	public function getShips() {
		
		return $this->_ships;
		
	}
	
	/**
	 * @param StateCombat $entityState
	 */
	public function addDefence(StateCombat $entityState) {
		
		$this->_defence[$entityState->getTechnology()->getType()] = $entityState;
		
	}
	
	/**
	 * @return StateCombat[]
	 */
	public function getDefence() {
		
		return $this->_defence;
		
	}
	
}