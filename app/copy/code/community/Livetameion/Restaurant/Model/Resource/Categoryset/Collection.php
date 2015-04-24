<?php
/**
 * @author     Jason at TwinCreations <twincreations.co.uk>
 * @copyright  Copyright (c) 2013 TwinCreations <http://twincreations.co.uk/>
 */

class Livetameion_Restaurant_Model_Resource_Categoryset_Collection extends Mage_Eav_Model_Entity_Collection_Abstract {
	
	protected function _construct() {
		$this->_init('restaurant/categoryset');
	}
	
}
