<?php
/**
 * @author     Jason at TwinCreations <twincreations.co.uk>
 * @copyright  Copyright (c) 2013 TwinCreations <http://twincreations.co.uk/>
 */

class Livetameion_Restaurant_Helper_Data extends Mage_Core_Helper_Data {
	
	const MARKETPLACE_ENABLE = "marketplace/marketplace/enable";
const MARKETPLACE_STATUS_APPROVED = "marketplace/status/approved";

	public function isMarketplaceEnabled() {
		//return (bool) Mage::getStoreConfig(self::MARKETPLACE_ENABLE, Mage::app()->getStore());
		return true;
	}
	
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


		public function getAllstoreColletion()
		{
			return Mage::app()->getStores();
		}
		public function getAllCategories()
		{
			$category=Mage::getModel('catalog/category')
			->getCollection()
			->setStoreId($store_id)
			->setOrder('position', 'asc')
			->addFieldToFilter('is_active', array('eq'=>'1'))
			->addAttributeToSelect('*');
			return $category;
		}



	public function getStoreData(){
		$store_info=array();	
		$allStores  = Mage::helper('restaurant')->getAllstoreColletion();
		foreach ($allStores as $_eachStoreId => $val) 
		{			
		$catname = Mage::app()->getStore($_eachStoreId)->getName();
		$catid = Mage::app()->getStore($_eachStoreId)->getId();
		$store_info[$catid]	=  $catname;
		}
		return $store_info;
	}
	
	public function getAllCategoriesDATA(){
		$category_info=array();	
		$category  = $this->getAllCategories();
		foreach ($category as $cat)
		{				
		$category_info[$cat->getId()]= $cat->getName();
		}
		return $category_info;
	}
	
	public function getMenuItemsFor($menu_id) {
		$items = Mage::getModel("restaurant/item")->getCollection()->addFieldToFilter("restaurantmenu_id",$menu_id);
		return $items;
	}
}
