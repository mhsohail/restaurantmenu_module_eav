<?php
/**
 * @author     Jason at TwinCreations <twincreations.co.uk>
 * @copyright  Copyright (c) 2013 TwinCreations <http://twincreations.co.uk/>
 */

class TC_Skeleton_Model_Resource_Setup extends Mage_Eav_Model_Entity_Setup
{
 
    public function getDefaultEntities() {
        return array(
            TC_Skeleton_Model_Skeleton::ENTITY => array(
                'entity_model' => 'tc_skeleton/skeleton',
                'table' => 'tc_skeleton/skeleton', /* Maps to the config.xml > global > models > tc_skeleton_resource > entities > skeleton */
                'attributes' => array(
                    'first_name' => array(
                        'type' => 'varchar',
                        'label' => 'First name',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 10,
                        'position' => 10,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),                     
                    'last_name' => array(
                        'type' => 'varchar',
                        'label' => 'Last name',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 20,
                        'position' => 20,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),  
                    'email' => array(
                        'type' => 'varchar',
                        'label' => 'Email',
                        'input' => 'text',
                        'required' => true,
                        'sort_order' => 30,
                        'position' => 30,
                        'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                    ),     
                    'address' => array(
                        'type'               => 'text',
                        'label'              => 'Address',
                        'input'              => 'multiline',
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
                )
            )
        );
    }
}
