<?php
/**
 * Created by PhpStorm.
 * User: Trinhnv
 * Date: 8/10/2015
 * Time: 11:13 AM
 */
class Magento_Slide_Model_Resource_Slide extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('slide/slide', 'id');
    }
}