<?php
class Livetameion_Restaurant_Block_Add extends Mage_Core_Block_Template {  
	
	public function __construct() {
		parent::__construct();
		$customerId = Mage::getSingleton('customer/session')->getCustomerId();        
	}
	public function getBackUrl() {
		if ($this->getData('back_url')) {
			return $this->getData('back_url');
		} else {
			return $this->getUrl('restaurant');
		}
	}
}
