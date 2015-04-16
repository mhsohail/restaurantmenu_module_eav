<?php
/**
 * @author     Jason at TwinCreations <twincreations.co.uk>
 * @copyright  Copyright (c) 2013 TwinCreations <http://twincreations.co.uk/>
 */

class TC_Skeleton_Model_Resource_Skeleton extends Mage_Eav_Model_Entity_Abstract
{
    public function __construct()
    {
        $resource = Mage::getSingleton('core/resource');
        
        $this->setType(TC_Skeleton_Model_Skeleton::ENTITY); 
 
        $this->setConnection(
            $resource->getConnection('tc_skeleton_read'),
            $resource->getConnection('tc_skeleton_write')
        );
    }
}
