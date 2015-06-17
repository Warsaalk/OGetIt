<?php
namespace OGetIt\CombatReport\Helper;

use OGetIt\Common\OGetIt_Value;
use OGetIt\Common\OGetIt_Resources;

trait OGetIt_Combat_ChildValue {
	
	/**
	 * @param OGetIt_Value[] $children
	 * @param string $byLosses
	 * @return OGetIt_Resources
	 */
	protected function getChildrenValue($children, $byLosses = false) {
		
		$value = new OGetIt_Resources(0, 0, 0);
		
		foreach ($children as $child) {
			$value->add($child->getValue($byLosses));
		}
		
		return $value;
		
	}
	
}