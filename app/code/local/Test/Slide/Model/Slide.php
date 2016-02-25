<?php
/**
 * Created by PhpStorm.
 * User: Trinhnv
 * Date: 8/10/2015
 * Time: 11:10 AM
 */
class Magento_Slide_Model_Slide extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('slide/slide');
        parent::_construct();
    }
}