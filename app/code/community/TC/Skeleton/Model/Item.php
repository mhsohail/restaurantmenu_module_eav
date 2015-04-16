<?php
/**
 * @author     Jason at TwinCreations <twincreations.co.uk>
 * @copyright  Copyright (c) 2013 TwinCreations <http://twincreations.co.uk/>
 */

class TC_Skeleton_Model_Item extends Mage_Core_Model_Abstract
{
    const ENTITY = 'tc_skeleton_item';
    protected $_eventPrefix = 'tc_skeleton';
    protected $_eventObject = 'item';
	
    function _construct()
    {
        $this->_init('tc_skeleton/item');
    }
}
