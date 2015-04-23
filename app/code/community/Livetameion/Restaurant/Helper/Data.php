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
	
	public function getActiveCategories() {
		$customer_id = Mage::getSingleton('customer/session')->getId();
		$categorysets = Mage::getModel('restaurant/categoryset')
			->getCollection()
			->addAttributeToFilter("is_active", 1)
			->addAttributeToFilter("merchant_id", $customer_id);
		foreach($categorysets as $categoryset) {
			$categoryset = Mage::getModel('restaurant/categoryset')->load($categoryset->getEntityId());
			$active_categoryset_id = $categoryset->getEntityId();
		}
		
		$categories = Mage::getModel('restaurant/category')
			->getCollection()
			->addAttributeToFilter("merchant_id", $customer_id)
			->addAttributeToFilter("categoryset_id", $active_categoryset_id);
			
		return $categories;
	}
	
	public function saveMenuItem($data) {
		$actionName = Mage::app()->getRequest()->getActionName();
		$edit_mode = ($actionName == "update" && isset($data["item_id"]) && !empty($data["item_id"]));
		
		if(!empty($data)) {
			if($edit_mode) {
				$itemModel = Mage::getModel('restaurant/item')->load($data["item_id"]);
			} else {
				$itemModel = Mage::getModel('restaurant/item');
			}
			
			if(!$edit_mode) {
				$itemModel->setRestaurantMenuId($data['restaurantmenu_id']);
			}
			$itemModel->setName($data['item_name'][0])
				->setDescription($data['description'][0])
				->setImage($data['item_image'])
				->setSize($data['size'][0])
				->setCategoryIds($data['category'][0]);
			if($data['size'][0] == Livetameion_Restaurant_Model_Item::SINGLE_SIZE) {
				$itemModel->setSingleSizePrice($data['single_size_price'][0]);
			} else {
				$itemModel->setSmallSizePrice($data['small_size_price'][0])
					->setMediumSizePrice($data['medium_size_price'][0])
					->setLargeSizePrice($data['large_size_price'][0])
					->setHalfOrderPrice($data['half_order_price'][0])
					->setFullOrderPrice($data['full_order_price'][0])
					->setChildOrderPrice($data['child_order_price'][0]);
			}
			
			if($edit_mode) {
				$itemModel->setId($data["item_id"])->save();
			} else {
				$itemModel->save();
			}
			$itemModel->unsetData();
		}
	}
	
	public function getAllstoreColletion() {
		return Mage::app()->getStores();
	}
	
	public function getAllCategories() {
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
