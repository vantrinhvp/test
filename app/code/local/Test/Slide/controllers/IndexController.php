<?php
/**
 * Created by PhpStorm.
 * User: Trinhnv
 * Date: 8/10/2015
 * Time: 11:30 AM
 */
class Magento_Slide_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock("head")->setTitle($this->__("Slide"));
        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
        $breadcrumbs->addCrumb("home", array(
            "label" =>$this->__("Home Page"),
            "title" =>$this->__("Home Page"),
            "link" => Mage::getBaseUrl()
        ));
        $this->renderLayout();
    }
}