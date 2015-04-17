<?php
/**
 * @author     Jason at TwinCreations <twincreations.co.uk>
 * @copyright  Copyright (c) 2013 TwinCreations <http://twincreations.co.uk/>
 */

class Livetameion_Restaurant_Model_Resource_Setup extends Mage_Eav_Model_Entity_Setup {
	public function getDefaultEntities() {
		return array(
			Livetameion_Restaurant_Model_Item::ENTITY => array(
                'entity_model' => 'restaurant/item',
                'table' => 'restaurant/item', /* Maps to the config.xml > global > models > restaurant_resource > entities > item */
                'attributes' => array(
                    'name' => array(
                        'type' => 'varchar',
                        'label' => 'Name',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 10,
                        'position' => 10,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),                     
                    'price' => array(
                        'type' => 'int',
                        'label' => 'Price',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 20,
                        'position' => 20,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),  
                    'image' => array(
                        'type' => 'varchar',
                        'label' => 'Image',
                        'input' => 'file',
                        'required' => true,
                        'sort_order' => 30,
                        'position' => 30,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
                    'category' => array(
                        'type'               => 'text',
                        'label'              => 'Category',
                        'input'              => 'select',
                        'sort_order'         => 40,
                        'multiline_count'    => 2,
                        'validate_rules'     => 'a:2:{s:15:"max_text_length";i:255;s:15:"min_text_length";i:1;}',
                        'position'           => 40,
                        'required' => false,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
                    'is_active' => array(
                        'type' => 'int',
                        'label' => 'Is Active',
                        'input' => 'text',
                        'required' => false,                        
                        'sort_order' => 50,
                        'position' => 50,
                        'required' => false,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
					'category_ids' => array(
                        'type' => 'varchar',
                        'label' => 'Category Ids',
                        'input' => 'check',
                        'required' => true,
                        'sort_order' => 50,
                        'position' => 50,
                        'required' => true,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
					'category_set_id' => array(
                        'type' => 'int',
                        'label' => 'Category Ids',
                        'input' => 'check',
                        'required' => true,
                        'sort_order' => 50,
                        'position' => 50,
                        'required' => true,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
                )
            ),
			Livetameion_Restaurant_Model_Category::ENTITY => array(
                'entity_model' => 'restaurant/category',
                'table' => 'restaurant/category', /* Maps to the config.xml > global > models > restaurant_resource > entities > item */
                'attributes' => array(
                    'name' => array(
                        'type' => 'varchar',
                        'label' => 'Name',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 10,
                        'position' => 10,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
					'menu_ids' => array(
                        'type' => 'varchar',
                        'label' => 'Menu Ids',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 10,
                        'position' => 10,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
					'item_ids' => array(
                        'type' => 'varchar',
                        'label' => 'Item Ids',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 10,
                        'position' => 10,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
                    'is_active' => array(
                        'type' => 'int',
                        'label' => 'Is Active',
                        'input' => 'text',
                        'required' => false,                        
                        'sort_order' => 50,
                        'position' => 50,
                        'required' => false,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
                )
            ),
			Livetameion_Restaurant_Model_Menu::ENTITY => array(
				'entity_model' => 'restaurant/menu',
                'table' => 'restaurant/menu', /* Maps to the config.xml > global > models > restaurant_resource > entities > item */
                'attributes' => array(
                    'name' => array(
                        'type' => 'varchar',
                        'label' => 'Name',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 10,
                        'position' => 10,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
					'merchant_id' => array(
                        'type' => 'int',
                        'label' => 'Merchant Id',
                        'input' => 'hidden',
                        'required' => true,
                        'sort_order' => 10,
                        'position' => 10,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),                    
                    'is_active' => array(
                        'type' => 'int',
                        'label' => 'Is Active',
                        'input' => 'text',
                        'required' => false,                        
                        'sort_order' => 50,
                        'position' => 50,
                        'required' => false,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),
                )
            )
        );
    }
}
