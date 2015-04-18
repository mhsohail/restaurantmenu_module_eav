<?php
class Livetameion_Restaurant_CategorysetController extends Mage_Core_Controller_Front_Action {
	
	protected function _getSession() {
		return Mage::getSingleton('restaurant/session');
    }
	
	protected function _validateCustomerLogin() {
		$session = Mage::getSingleton('customer/session');
		if (!$session->isLoggedIn()) {
			$session->setAfterAuthUrl(Mage::helper('core/url')->getCurrentUrl());
			$session->setBeforeAuthUrl(Mage::helper('core/url')->getCurrentUrl());
			$this->_redirect('customer/account/login/');
			return $this;
		} elseif(!Mage::helper('restaurant')->isMarketplaceActiveSellar()){
			$this->_redirect('customer/account/');
		}
	}
	
	public function indexAction() {
		$this->_validateCustomerLogin();
		$this->loadLayout();  
		$this->_initLayoutMessages('restaurant/session');  
		$this->renderLayout();
	}
	
	public function addAction() {
		$this->_validateCustomerLogin();
		$this->loadLayout();
		$this->_initLayoutMessages('restaurant/session');
		$this->renderLayout();
	}
	
	public function editAction() {
		$this->_validateCustomerLogin();
		$this->loadLayout();    
		$this->_initLayoutMessages('restaurant/session');
		$this->renderLayout(); 
	}
	
	public function showAction() {
		$this->_validateCustomerLogin();
		$this->loadLayout();  
		$this->_initLayoutMessages('restaurant/session');  
		$this->renderLayout();
	}
	
	public function gettoreategoryAction() {
		//print_r($_POST);
		$this->_validateCustomerLogin();
		$store_id= (int) $_POST['store_id'];
		
		if($store_id == 1) {
			// main website store
			$category_name = "Distribution Center";
			$category_id = $this->getCategoryIdFor($category_name);
		} else if($store_id == 2) {
			// clikaroo
			$category_name = "Clikaroo";
			$category_id = $this->getCategoryIdFor($category_name);
		} else if($store_id == 3) {
			//cometothex
			$category_name = "Community Marketplace";
			$category_id = $this->getCategoryIdFor($category_name);
		} else {
			$root_category_id = Mage::app()->getStore($store_id)->getRootCategoryId();
			$category_id = $root_category_id;
			/*
			$categories = Mage::getModel('catalog/category')
				->getCollection()
				->addFieldToFilter('path', array('like'=> "1/$root_category_id/%"));
			echo $categories->count();
			*/
		}
		
		if($store_id) {
			//$html_ .='<select name="category_ids[]" id="category" class="required-entry select multiselect" multiple="multiple">';
			$html_ .='<select name="sub_category_1" id="sub_category_1" class="required-entry select multiselect" onchange="fill_subcategories(2, this.value);">';
			
			$categories = Mage::getModel('catalog/category')
			->getCollection()
			->setStoreId($store_id)
			->setOrder('position', 'asc')
			->addFieldToFilter('is_active', array('eq'=>'1'))
			->addAttributeToSelect('*');
			
			/*
			$categories = Mage::getModel('catalog/category')->getCollection()
			->addAttributeToSelect('*')//or you can just add some attributes
			->addAttributeToFilter('level', 1)//2 is actually the first level
			->addAttributeToFilter('is_active', 1); //if you want only active categories
			*/
			
			// The following line of code is for livetameion, clikaroo and cometothex stores
			//$categories = Mage::getModel('catalog/category')->getCategories($category_id);
			
			$html_ .='<option value="" selected>Select Category</option>';
			foreach ($categories as $cat) {
				$html_ .='<option value="'.$cat->getId().'">'.$cat->getName() . '</option>';
			}
			$html_ .='</select>';
			echo $html_ ;
		} else {
			echo '';
		}
	}
	
	function getCategoryIdFor($category_name) {
		$category = Mage::getResourceModel('catalog/category_collection')
			->addFieldToFilter('name', $category_name);
		
		// the below line gets the category data
		$catData = $category->getData();
		
		// the below line gets the category id
		$category_id = $catData[0]['entity_id'];
		
		return $category_id;
	}
	
	public function saveAction() {
		$this->_validateCustomerLogin();
		$customer_id = Mage::getSingleton('customer/session')->getId();
		$data = Mage::app()->getRequest()->getPost();
		
		$categorysetModel = Mage::getModel('restaurant/categoryset');
		if(!empty($data)) {
			$categorysetModel
				->setMerchantId($customer_id)
				->setName($data['name'])
				->setIsActive(0)
				->save();
		}
		$categoryset_id = $categorysetModel->getEntityId();
		$categorysetModel->unsetData();
		
		for($i = 0; $i < count($data['name']); $i++) {
			if(isset($_FILES['image']['name']) and (file_exists($_FILES['image']['tmp_name'][$i]))) {
				try {
					$uploader = new Varien_File_Uploader(array(
						'name' => $_FILES['image']['name'][$i],
						'type' => $_FILES['image']['type'][$i],
						'tmp_name' => $_FILES['image']['tmp_name'][$i],
						'error' => $_FILES['image']['error'][$i],
						'size' => $_FILES['image']['size'][$i]
					));
					
					//print_r($uploader);
					//$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png')); // or pdf or anything
					
					$uploader->setAllowRenameFiles(false);
					$new_file_name = time() . $customer_id;
					// setAllowRenameFiles(true) -> move your file in a folder the magento way
					// setAllowRenameFiles(true) -> move your file directly in the $path folder
					$uploader->setFilesDispersion(false);
					
					$path = Mage::getBaseDir('media') . DS."restaurant_menu/" ;
					$uplaoedFilename = $new_file_name . $_FILES['image']['name'][$i];
					$uploader->save($path, $new_file_name . $_FILES['image']['name'][$i]);
					//$uploader->save($path, $new_file_name);
					
					// SAVE POSTED DATA
					$data['image'] = $new_file_name . $_FILES['image']['name'][$i];
					
					echo "<pre>";
					print_r($data);
					
					$categoryModel = Mage::getModel('restaurant/category');
					if(!empty($data)) {
						$categoryModel
							->setName($data['name'][$i])
							->setMenuIds("1,2,3")
							->setItemIds("2,3,4")
							->setMerchantId($customer_id)
							->setCategorysetId($categoryset_id)
							->setImage($uplaoedFilename)
							->save();
						$categoryModel->unsetData();
					}
					Mage::getSingleton('core/session')->addSuccess('Successfully saved');
					Mage::getSingleton('core/session')->settestData(false);
					//print_r($data);
					//exit;
					// ENd SAVE POSTED DATA
				} catch(Exception $e) {
					//Mage::getSingleton('core/session')->addSuccess($e);
					echo $e->getMessage();
				}
			}
		}
		$this->_redirect("*/index/");
	}
	
	public function updateAction() {
		$this->_validateCustomerLogin();
		$customer_id = Mage::getSingleton('customer/session')->getId();
		
		if(isset($_FILES['item_image']['name']) and (file_exists($_FILES['item_image']['tmp_name']))) {
			try {
				$uploader = new Varien_File_Uploader('item_image');
				//print_r($uploader);
				$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png')); // or pdf or anything
				
				$uploader->setAllowRenameFiles(false);
				$new_file_name=time().$customer_id;
				// setAllowRenameFiles(true) -> move your file in a folder the magento way
				// setAllowRenameFiles(true) -> move your file directly in the $path folder
				$uploader->setFilesDispersion(false);
				
				$path = Mage::getBaseDir('media') . DS."restaurant_menu/";
				$uplaoedFilename=$new_file_name.$_FILES['item_image']['name'];
				$uploader->save($path, $new_file_name.$_FILES['item_image']['name']);
				//$uploader->save($path, $new_file_name);
				
				$post = Mage::app()->getRequest()->getPost();
				$post['item_image'] = $new_file_name.$_FILES['item_image']['name'];
				$all_categories=@implode(',', $post['category_ids']);
				
				$data = array(
					'name' => $post['item_name'],
					'price' => $post['item_price'],
					'category' => $post['category'],
					'image' => $post['item_image'],
				);
				
				$model = Mage::getModel('restaurant/item')->load($this->getRequest()->getParam('item_id'))->addData($data);
				$ad_id = $this->getRequest()->getParam('item_id');
				
				try {
					$model->setId($ad_id)->save();
					// in order to see the below message printed, remove $this->_redirect("*/*/") statement below.
					//echo "Data updated successfully.";
				} catch (Exception $e){
					echo $e->getMessage(); 
				}
			} catch(Exception $e) {
				Mage::getSingleton('core/session')->addSuccess($e);
				echo $e->getMessage();
			}
			$this->_redirect("*/index/");
		}
	}
	
	public function deleteAction() {
		$id = $this->getRequest()->getParam('id');
		$model = Mage::getModel('restaurant/categoryset');
		
		try {
			$model->setId($id)->delete();
			//echo "Data deleted successfully.";
			Mage::getSingleton('core/session')->addSuccess('Data deleted successfully.');
		} catch (Exception $e) {
			//echo $e->getMessage(); 
			Mage::getSingleton('core/session')->addSuccess($e->getMessage());
		}
		$this->_redirect("*/*/");
	}
	
	public function statusAction() {
		$customer_id = Mage::getSingleton('customer/session')->getId();
		$id = $this->getRequest()->getParam('id');
		$status = $this->getRequest()->getParam('status');
		$arrcustData = array('is_active' => $status);
		
		// make all category sets in-active first
		$categorysets = Mage::getModel('restaurant/categoryset')->getCollection();
		foreach($categorysets as $categoryset) {
			$categoryset = Mage::getModel('restaurant/categoryset')->load($categoryset->getEntityId());
			$categoryset->setIsActive(0);
			$categoryset->save();
		}
		
		// now make the clicked category set active
		$model = Mage::getModel('restaurant/categoryset')->load($id)->addData($arrcustData );
		try {
			$model->setId($id)->save();
			//echo "Data deleted successfully.";
			Mage::getSingleton('core/session')->addSuccess('Record has been updated successfully.');

		} catch (Exception $e){
			//echo $e->getMessage(); 
			Mage::getSingleton('core/session')->addSuccess($e->getMessage());
		}
		$this->_redirect("*/*/");
	}
	
	private function getUserIpAddress() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
}

