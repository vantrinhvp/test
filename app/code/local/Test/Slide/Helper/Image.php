<?php
/**
 * News Image Helper
 *
 * @author Magento
 */
class Magento_Slide_Helper_Image extends Mage_Core_Helper_Abstract
{

    const MEDIA_PATH    = 'news';


    const MAX_FILE_SIZE = 104857699;


    const MIN_HEIGHT = 50;


    const MAX_HEIGHT = 800;

    /**
     * Manimum image width in pixels
     *
     * @var int
     */
    const MIN_WIDTH = 50;

    /**
     * Maximum image width in pixels
     *
     * @var int
     */
    const MAX_WIDTH = 800;

    /**
     * Array of image size limitation
     *
     * @var array
     */
    protected $_imageSize   = array(
        'minheight'     => self::MIN_HEIGHT,
        'minwidth'      => self::MIN_WIDTH,
        'maxheight'     => self::MAX_HEIGHT,
        'maxwidth'      => self::MAX_WIDTH,
    );

    /**
     * Array of allowed file extensions
     *
     * @var array
     */
    protected $_allowedExtensions = array('jpg', 'gif', 'png');

    /**
     * Return the base media directory for News Item images
     *
     * @return string
     */
    public function getBaseDir()
    {
        return Mage::getBaseDir('media') . DS . self::MEDIA_PATH;
    }

    /**
     * Return the Base URL for News Item images
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return Mage::getBaseUrl('media') . '/' . self::MEDIA_PATH;
    }

    /**
     * Remove news item image by image filename
     *
     * @param string $imageFile
     * @return bool
     */
    public function removeImage($imageFile)
    {
        $io = new Varien_Io_File();
        $io->open(array('path' => $this->getBaseDir()));
        if ($io->fileExists($imageFile)) {
            return $io->rm($imageFile);
        }
        return false;
    }


    public function uploadImage($scope)
    {
        $adapter  = new Zend_File_Transfer_Adapter_Http();
        $adapter->addValidator('ImageSize', true, $this->_imageSize);
        $adapter->addValidator('Size', true, self::MAX_FILE_SIZE);
        if ($adapter->isUploaded($scope)) {
            // validate image
            if (!$adapter->isValid($scope)) {
                Mage::throwException(Mage::helper('slide')->__('Uploaded image is not valid'));
            }
            $upload = new Varien_File_Uploader($scope);
            $upload->setAllowCreateFolders(true);
            $upload->setAllowedExtensions($this->_allowedExtensions);
            $upload->setAllowRenameFiles(true);
            $upload->setFilesDispersion(false);
            if ($upload->save($this->getBaseDir())) {
                return $upload->getUploadedFileName();
            }
        }
        return false;
    }

}
