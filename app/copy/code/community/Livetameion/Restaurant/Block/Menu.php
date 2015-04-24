<?php
class Livetameion_Restaurant_Block_Menu extends Mage_Core_Block_Template {
	
	/*public function __construct() {
		parent::__construct();
		$collection = Mage::getModel('restaurant/menu')->getCollection();
		$this->setCollection($collection);
	}
	
	protected function _prepareLayout() {
		parent::_prepareLayout();

		$pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
		$pager->setAvailableLimit(array(5=>5,10=>10,20=>20,'all'=>'all'));
		$pager->setCollection($this->getCollection());
		$this->setChild('pager', $pager);
		$this->getCollection()->load();
		return $this;
	}

	public function getPagerHtml() {
		return $this->getChildHtml('pager');
	}*/
	public function __construct() {
		parent::__construct();   
			$loggedUser = Mage::getSingleton( 'customer/session', array('name' => 'frontend') );
            $customer = $loggedUser->getCustomer();
			$customerId = $customer->getId();
            
			//$customerId = Mage::getSingleton('customer/session')->getCustomerId();
			//exit;
			$collection = Mage::getModel('restaurant/menu')->getCollection()->addAttributeToFilter('merchant_id', $customerId);
			$this->setCollection($collection);
    }
 
    protected function _prepareLayout() {
		parent::_prepareLayout();
 
        $toolbar = $this->getToolbarBlock();
 
        // called prepare sortable parameters
        $collection = $this->getCollection();
 
        // use sortable parameters
        if ($orders = $this->getAvailableOrders()) {
            $toolbar->setAvailableOrders($orders);
        }
        if ($sort = $this->getSortBy()) {
            $toolbar->setDefaultOrder($sort);
        }
        if ($dir = $this->getDefaultDirection()) {
            $toolbar->setDefaultDirection($dir);
        }
        $toolbar->setCollection($collection);
 
        $this->setChild('toolbar', $toolbar);
        $this->getCollection()->load();
        return $this;
    }
    public function getDefaultDirection(){
        return 'desc';
    }
    public function getAvailableOrders(){
        return array('createddate'=> 'Created Time','store_id'=>'STORE','restaurantmenu_id'=>'ID');
    }
    public function getSortBy(){
        return 'restaurantmenu_id';
    }
    public function getToolbarBlock() {
        $block = $this->getLayout()->createBlock('restaurant/toolbar', microtime());
        return $block;
    }
    public function getMode()
    {
        return $this->getChild('toolbar')->getCurrentMode();
    }
 
    public function getToolbarHtml()
    {
        return $this->getChildHtml('toolbar');
    }
}
