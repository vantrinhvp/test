<?php

class Magento_Slide_Block_Adminhtml_Slide_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId("slide_tabs");
        $this->setDestElementId("edit_form");
        $this->setTitile(Mage::helper("slide")->__("Item Information"));
    }
    protected function _beforeToHtml()
    {
        $this->addTab("form_section", array(
            "label"=> Mage::helper("slide")->__("Item Information"),
            "title"=> Mage::helper("slide")->__("Item Information"),
            "content" =>$this->getLayout()->createBlock("slide/adminhtml_slide_edit_tab_form")->toHtml(),
        ));
        return parent::_beforeToHtml();
       /* $this->addTab('form_section', array(
            'label' => 'Contact Information',
            'title' => 'Contact Information',
            'content' => $this->getLayout()
                ->createBlock('slide/adminhtml_slide_edit_tab_form')
                ->toHtml()
        ));
        return parent::_beforeToHtml();*/
    }
}