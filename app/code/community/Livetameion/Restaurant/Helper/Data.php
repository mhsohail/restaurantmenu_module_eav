<?php
/**
 * @author     Jason at TwinCreations <twincreations.co.uk>
 * @copyright  Copyright (c) 2013 TwinCreations <http://twincreations.co.uk/>
 */

class Livetameion_Restaurant_Helper_Data extends Mage_Core_Helper_Data {
	
	public function isMarketplaceActiveSellar() {
		return true;
		/*if ($this->isMarketplaceEnabled()) {
		$customer = Mage::getSingleton('customer/session')->getCustomer();
		if ($customer->getStatus() == Mage::getStoreConfig(self::MARKETPLACE_STATUS_APPROVED) && (bool) $customer->getSellerSubscriber()) {
		return true;
		} else {
		return false;
		}
		} else {
		return false;
		}*/
	}
}
