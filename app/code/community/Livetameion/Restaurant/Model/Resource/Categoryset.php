<?php
/**
 * @author     Jason at TwinCreations <twincreations.co.uk>
 * @copyright  Copyright (c) 2013 TwinCreations <http://twincreations.co.uk/>
 */

class Livetameion_Restaurant_Model_Resource_Categoryset extends Mage_Eav_Model_Entity_Abstract {
	public function __construct() {
		$resource = Mage::getSingleton('core/resource');
		
		$this->setType(Livetameion_Restaurant_Model_Categoryset::ENTITY); 
		
		$this->setConnection(
			$resource->getConnection('restaurant_read'),
			$resource->getConnection('restaurant_write')
		);
	}
}
