<?php

/**
 * Created by PhpStorm.
 * User: Trinhnv
 * Date: 8/10/2015
 * Time: 1:53 PM
 */
class Magento_Slide_Adminhtml_SlideController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu("slide/slide")
            ->_addBreadcrumb(
                Mage::helper("adminhtml")->__("Slide  Manager"),
                Mage::helper("adminhtml")->__("Slide Manager"));
        return $this;
    }

    public function indexAction()
    {
        $this->_initAction();
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->_title($this->__("Slide"));
        $this->_title($this->__("Slide"));
        $this->_title($this->__("Edit Item"));

        $id = $this->getRequest()->getParam("id");
        $model = Mage::getModel("slide/slide")->load($id);
        if ($model->getId()) {
            Mage::register("slide_data", $model);
            $this->loadLayout();
            $this->_setActiveMenu("slide/slide");
            $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Slide Manager"), Mage::helper("adminhtml")->__("Slide Manager"));
            $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Slide Description"), Mage::helper("adminhtml")->__("Slide Description"));
            $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock("slide/adminhtml_slide_edit"))->_addLeft($this->getLayout()->createBlock("slide/adminhtml_slide_edit_tabs"));
            $this->renderLayout();
        } else {
            Mage::getSingleton("adminhtml/session")->addError(Mage::helper("slide")->__("Item does not exist."));
            $this->_redirect("*/*/");
        }
    }

    public function newAction()
    {
        $this->_title($this->__("Slide"));
        $this->_title($this->__("Slide"));
        $this->_title($this->__("New Item"));

        $id = $this->getRequest()->getParam("id");
        $model = Mage::getModel("slide/slide")->load($id);

        $data = Mage::getSingleton("adminhtml/session")->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        Mage::register("slide_data", $model);

        $this->loadLayout();
        $this->_setActiveMenu("slide/slide");

        $this->getLayout()->createBlock("head");

        $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Slide Manager"), Mage::helper("adminhtml")->__("Slide Manager"));
        $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Slide Description"), Mage::helper("adminhtml")->__("Slide Description"));

        $this->_addContent($this->getLayout()->createBlock("slide/adminhtml_slide_edit"))->_addLeft($this->getLayout()->createBlock("slide/adminhtml_slide_edit_tabs"));

        $this->renderLayout();
    }

    public function saveAction()
    {

        $post_data = $this->getRequest()->getPost();
        if ($post_data) {

            try {
                try {
                    if ((bool)$post_data['image']['delete'] == 1) {
                        $post_data['image'] = '';
                    } else {
                        unset($post_data['image']);
                        if (isset($_FILES)) {
                            if ($_FILES['image']['name']) {
                                if ($this->getRequest()->getParam("id")) {
                                    $model = Mage::getModel("slide/slide")->load($this->getRequest()->getParam("id"));
                                    if ($model->getData('image')) {
                                        $io = new Varien_Io_File();
                                        $io->rm(Mage::getBaseDir('media') . DS . implode(DS, explode('/', $model->getData('image'))));
                                    }
                                }
                                $path = Mage::getBaseDir('media') . DS . 'slide' . DS . 'slide' . DS;
                                $uploader = new Varien_File_Uploader('image');
                                $uploader->setAllowedExtensions(array('jpg', 'png', 'gif'));
                                $uploader->setAllowRenameFiles(false);
                                $uploader->setFilesDispersion(false);
                                $destFile = $path . $_FILES['image']['name'];
                                $filename = $uploader->getNewFileName($destFile);
                                $uploader->save($path, $filename);

                                $post_data['image'] = 'slide/slide/' . $filename;
                            }
                        }
                    }

                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                    return;
                }
                $model = Mage::getModel("slide/slide")
                    ->addData($post_data)
                    ->setId($this->getRequest()->getParam("id"))
                    ->save();
                Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Slide was successfully saved"));
                Mage::getSingleton("adminhtml/session")->setSlideData(false);
                if ($this->getRequest()->getParam("back")) {
                    $this->_redirect("*/*/edit", array("id" => $model->getId()));
                    return;
                }
                $this->_redirect("*/*/");
                return;
            } catch (Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                Mage::getSingleton("adminhtml/session")->setSlideData($this->getRequest()->getPost());
                $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
                return;
            }
        }
        $this->_redirect("*/*/");
    }

    public function deleteAction()
    {
        if ($this->getRequest()->getParam("id") > 0) {
            try {
                $model = Mage::getModel("slide/slide");
                $model->setId($this->getRequest()->getParam("id"))->delete();
                Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Done!"));
                $this->_redirect("*/*/");
            } catch (Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
            }
        }
        $this->_redirect("*/*/");
    }

    public function massRemoveAction()
    {
        try {
            $ids = $this->getRequest()->getPost('ids', array());
            foreach ($ids as $id) {
                $model = Mage::getModel("slide/slide");
                $model->setId($id)->delete();
            }
            Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
        } catch (Exception $e) {
            Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }

    public function massStatusAction()
    {
        $ids = $this->getRequest()->getParam('id');
        if(!is_array($ids)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select Banner(s)'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = Mage::getSingleton('slide/slide');
                    $model->load($id)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($ids))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }

}