<?php
/**
 * Created by PhpStorm.
 * User: Trinhnv
 * Date: 8/12/2015
 * Time: 6:02 PM
 */
class Magento_Slide_Helper_Show extends Mage_Core_Helper_Abstract
{

     public function getSlideEnabled()
     {
         return Mage::getStoreConfig('generalsetting/slidegroup/enable',Mage::app()->getStore()->getIsActive());
     }

    public function getPos()
    {
        return Mage::getStoreConfig('generalsetting/slidegroup/position',Mage::app()->getStore()->getStoreId());
    }

    public function getSlideSpeed()
    {
        return Mage::getStoreConfig('generalsetting/slidegroup/slidespeed',Mage::app()->getStore()->getStoreId());
    }

    public function getLimit()
    {
        return Mage::getStoreConfig('generalsetting/slidegroup/numimage',Mage::app()->getStore()->getStoreId());
    }

    public function showHomepage()
    {
        return Mage::getStoreConfig('generalsetting/slidegroup/showhomepage',Mage::app()->getStore()->getStoreId());
    }

    public function showCategory()
    {
        return Mage::getStoreConfig('generalsetting/slidegroup/showcategory',Mage::app()->getStore()->getStoreId());
    }

    public function showProduct()
    {
        return Mage::getStoreConfig('generalsetting/slidegroup/showProduct',Mage::app()->getStore()->getStoreId());
    }

    public function getAllImages(){
        $getModel=Mage::getModel('slide/slide')->getCollection()->setOrder('id', 'DESC');
        $getModel->getSelect()->limit($this->getLimit());
        $a= $this->getPos();
        $getModel->addFieldToFilter('status',1);
        $getModel->addFieldToFilter('id',array("from"=>$a));
        $getModel->addFieldToFilter('page',array("eq"=>'1'));
        return $getModel;
    }

    public function getCatelogy(){
        $getModel=Mage::getModel('slide/slide')->getCollection()->setOrder('id', 'DESC');
        $getModel->getSelect()->limit($this->getLimit());
        $a= $this->getPos();
        $getModel->addFieldToFilter('status',1);
        $getModel->addFieldToFilter('id',array("from"=>$a));
        $getModel->addFieldToFilter('page',array("eq"=>'2'));
        return $getModel;
    }

    public function getProduct(){
        $getModel=Mage::getModel('slide/slide')->getCollection()->setOrder('id', 'DESC');
        $getModel->getSelect()->limit($this->getLimit());
        $a= $this->getPos();
        $getModel->addFieldToFilter('status',1);
        $getModel->addFieldToFilter('id',array("from"=>$a));
        $getModel->addFieldToFilter('page',array("eq"=>'3'));
        return $getModel;
    }
}
