<?php
/**
 * @author     Jason at TwinCreations <twincreations.co.uk>
 * @copyright  Copyright (c) 2013 TwinCreations <http://twincreations.co.uk/>
 */

class Livetameion_Restaurant_Model_Category extends Mage_Core_Model_Abstract {
	const ENTITY = 'restaurant_category';
	protected $_eventPrefix = 'restaurant';
	protected $_eventObject = 'category';
	
	function _construct() {
		$this->_init('restaurant/category');
	}
	
	function getTest() {
		echo "get test method...";
	}
}
