<?php
/**
 * @author     Jason at TwinCreations <twincreations.co.uk>
 * @copyright  Copyright (c) 2013 TwinCreations <http://twincreations.co.uk/>
 */

class Livetameion_Restaurant_Model_Categoryset extends Mage_Core_Model_Abstract {
	const ENTITY = 'restaurant_categoryset';
	protected $_eventPrefix = 'restaurant';
	protected $_eventObject = 'categoryset';
	
	function _construct() {
		$this->_init('restaurant/categoryset');
	}
	
	function getTest() {
		echo "get test method...";
	}
}
