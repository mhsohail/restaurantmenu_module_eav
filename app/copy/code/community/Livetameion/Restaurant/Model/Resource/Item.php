<?php
/**
 * @author     Jason at TwinCreations <twincreations.co.uk>
 * @copyright  Copyright (c) 2013 TwinCreations <http://twincreations.co.uk/>
 */

class Livetameion_Restaurant_Model_Resource_Item extends Mage_Eav_Model_Entity_Abstract
{
    public function __construct()
    {
        $resource = Mage::getSingleton('core/resource');
        
        $this->setType(Livetameion_Restaurant_Model_Item::ENTITY); 
		
        $this->setConnection(
            $resource->getConnection('restaurant_read'),
            $resource->getConnection('restaurant_write')
        );
    }
}
