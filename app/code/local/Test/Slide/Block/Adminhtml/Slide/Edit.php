<?php class Magento_Slide_Block_Adminhtml_Slide_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'slide';
        $this->_controller = 'adminhtml_slide';
        $this->_updateButton("save", "label", Mage::helper("slide")->__("Save Item"));
        $this->_updateButton("delete", "label", Mage::helper("slide")->__("Del Item"));

        $this->_addButton("saveadndcontinue", array(
            "label" =>Mage::helper("slide")->__("Save And Continue Edit"),
            "onclick" => "saveAndContinueEdit()",
            "class"   => "save",
        ),-100);

        $this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
    }

    public function getHeaderText()
    {
        if( Mage::registry("slide_data") && Mage::registry("slide_data")->getId() ){
            return Mage::helper("slide")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("slide_data")->getId()));
        }
        else{
            return Mage::helper("slide")->__("Add Item");
        }

    }
}