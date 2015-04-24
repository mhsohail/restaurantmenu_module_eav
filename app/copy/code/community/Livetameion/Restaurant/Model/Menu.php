<?php
/**
 * @author     Jason at TwinCreations <twincreations.co.uk>
 * @copyright  Copyright (c) 2013 TwinCreations <http://twincreations.co.uk/>
 */

class Livetameion_Restaurant_Model_Menu extends Mage_Core_Model_Abstract {
	const ENTITY = 'restaurant_menu';
	protected $_eventPrefix = 'restaurant';
	protected $_eventObject = 'menu';
	
	function _construct() {
		$this->_init('restaurant/menu');
	}
	
	function getTest() {
		echo "get test method...";
	}
}
