<?php

/**
 * Created by PhpStorm.
 * User: Trinhnv
 * Date: 8/11/2015
 * Time: 2:17 AM
 */
class Magento_Slide_Block_Adminhtml_Slide_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();


//        if (Mage::getSingleton("adminhtml/session")->getSlideData()) {
//            $form->setValues(Mage::getSingleton("adminhtml/session")->getSlideData());
//            Mage::getSingleton("adminhtml/session")->setSlideDatat(null);


        $fieldset = $form->addFieldset("slide_form", array(
            "legend" => Mage::helper("slide")->__("Item information")
        ));

        $fieldset->addField("title", "text", array(
            "label" => Mage::helper("slide")->__("Title"),
            "class" => "required-entry",
            "required" => true,
            "name" => "title"
        ));
        $fieldset->addField("image", "image", array(
            "label" => Mage::helper("slide")->__("Image"),
            "name" => "image",
            "note" => "(*.jpg, *.png, *.gif)"
        ));

        $fieldset->addField("description", "textarea", array(
            "label" => Mage::helper("slide")->__("Descriptsion"),
            "name" => "description"
        ));

        $fieldset->addField("url", "text", array(
            "label" => Mage::helper("slide")->__("URL"),
            "name" => "url"
        ));

        $fieldset->addField("position", "text", array(
            "label" => Mage::helper("slide")->__("Position"),
            "name" => "position"
        ));

        $fieldset->addField("page", "select", array(
            "label" => Mage::helper("slide")->__("Visit"),
            "name" => "page",
            'values' => array('-1'=>'Please Select..','1' => 'Homepage','2' => 'Category', '3'=>'Product Page'),
            "class" => "required-entry",
            "required" => true
        ));

        $fieldset->addField("status", "select", array(
            "label" => Mage::helper("slide")->__("Status"),
            "values" => Magento_Slide_Block_Adminhtml_Slide_Grid::getValueArray5(),
            "name" => "status",
            "class" => "required-entry",
            "required" => true
        ));
        if (Mage::registry("slide_data")) {
            $form->setValues(Mage::registry("slide_data")->getData());
        }
        $this->setForm($form);
        return parent::_prepareForm();
    }
}