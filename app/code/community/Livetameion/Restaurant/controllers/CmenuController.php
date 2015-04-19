<?php
class Livetameion_Restaurant_CmenuController extends Mage_Core_Controller_Front_Action {
	
	public function indexAction() {
		
	}
	
	public function showAction() {
		$this->loadLayout(); 
		$this->renderLayout();
	}
	
	public function categoryAction() {
		$this->loadLayout(); 
		$this->renderLayout();
	}
}
