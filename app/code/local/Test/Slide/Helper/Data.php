<?php

/**
 * Created by PhpStorm.
 * User: Trinhnv
 * Date: 8/10/2015
 * Time: 10:26 AM
 */
class Magento_Slide_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function uploadImg($file)
    {
        $fileResult = '';

        if (isset($_FILES['image']) && file_exists($_FILES['image']['tmp_name'])) {
            $path = Mage::getBaseDir('media') . DS . 'slide' . DS . 'slide' . DS;
            $fileName = preg_replace('/[^\w\d\._ -]/si', '_', $_FILES['image']['name']);
            $uploader = new Varien_File_Uploader('image');
            $uploader->setAllowedExtensions(array('jpg', 'png', 'gif'));
            $uploader->setAllowRenameFiles(false);
            $uploader->setFilesDispersion(false);
//            $destFile = $path . $_FILES['image']['name'];
//            $filename = $uploader->getNewFileName($destFile);
            $uploader->save($path, $fileName);
            $imgname = $uploader->getCorrectFileName($fileName);
            $fileResult = 'slide/slide/' . $imgname;
        }
        return $fileResult;
    }
}