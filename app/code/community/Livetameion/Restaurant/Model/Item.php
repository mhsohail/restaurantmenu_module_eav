<?php
/**
 * @author     Jason at TwinCreations <twincreations.co.uk>
 * @copyright  Copyright (c) 2013 TwinCreations <http://twincreations.co.uk/>
 */

class Livetameion_Restaurant_Model_Item extends Mage_Core_Model_Abstract {
	const ENTITY = 'restaurant_item';
	protected $_eventPrefix = 'restaurant';
	protected $_eventObject = 'item';
	
	function _construct() {
		$this->_init('restaurant/item');
	}
	
	function getTest() {
		echo "get test method...";
	}
}
