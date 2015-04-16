<?php
/**
 * @author     Jason at TwinCreations <twincreations.co.uk>
 * @copyright  Copyright (c) 2013 TwinCreations <http://twincreations.co.uk/>
 */

class TC_Skeleton_Model_Skeleton extends Mage_Core_Model_Abstract
{
    const ENTITY = 'tc_skeleton_skeleton';
    protected $_eventPrefix = 'tc_skeleton';
    protected $_eventObject = 'skeleton';
 
    function _construct()
    {
        $this->_init('tc_skeleton/skeleton');
    }
}
