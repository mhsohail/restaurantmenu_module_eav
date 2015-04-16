<?php
/**
 * Livetameion Restaurant Plugin
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * It is available on the World Wide Web at:
 * http://opensource.org/licenses/osl-3.0.php
 * If you are unable to access it on the World Wide Web, please send an email
 * To: javed.alam@cwsinfotech.com.  We will send you a copy of the source file.
 *
 * @category   Restaurant Plugin
 * @package    Livetameion_Restaurant
 * @copyright  Copyright (c) 2014 Livetameion Technology Pvt. Ltd., India
 *             http://www.cwstechnology.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author     Javed Alam <javed.alam@cwsinfotech.com>
 */

class Livetameion_Restaurant_Model_Session extends Mage_Core_Model_Session_Abstract
{
    public function __construct() {
        $this->init('restaurant');
    }
}
