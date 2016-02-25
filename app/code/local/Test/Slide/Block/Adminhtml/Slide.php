<?php
/**
 * Created by PhpStorm.
 * User: Trinhnv
 * Date: 8/10/2015
 * Time: 1:59 PM
 */
class Magento_Slide_Block_Adminhtml_Slide extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_slide';
        $this->_blockGroup = 'slide';
        $this->_headerText = Mage::helper('slide')->__('Slide Manager');
        $this->_addButtonLabel = Mage::helper('slide')->__('Add new Item');
        parent::__construct();
    }
}