<?php
/**
 * Created by PhpStorm.
 * User: Trinhnv
 * Date: 8/10/2015
 * Time: 2:05 PM
 */
class Magento_Slide_Block_Adminhtml_Slide_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {

        parent::__construct();
        $this->setId('slide_list_grid');
        $this->setDefaultSort("id");
        $this->setDefaultDir("DESC");
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('slide/slide')->getResourceCollection();

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn("id", array(
            "header"=> Mage::helper("slide")->__("ID"),
            "index" => "id",
        ));

        $this->addColumn("title",array(
            "header"=>Mage::helper("slide")->__("Title"),
            "index"=>"title",
        ));

        $this->addColumn("url",array(
            "header"=>Mage::helper("slide")->__("URL"),
            "index"=>"url"
        ));

        $this->addColumn("position",array(
            "header"=>Mage::helper("slide")->__("Position"),
            "index"=>"position"
        ));

        $this->addColumn('page', array(
                'header' => Mage::helper('slide')->__('Page'),
                'index' => 'page',
                'type' => 'options',
                'options' => array(
                    1 => Hompage,
                    2 => category,
                    3 => product_page
                ),
            )
        );

        $this->addColumn("status",array(
            "header"=>Mage::helper("slide")->__("Status"),
            "index"=>"status",
            "type"=>"options",
            "options"=>Magento_Slide_Block_Adminhtml_Slide_Grid::getOptionArray5(),
        ));
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl("*/*/edit", array("id" => $row->getId()));
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField("id");
        $this->getMassactionBlock()->setFormFieldName("ids");
        $this->getMassactionBlock()->setUseSelectAll(true);
        $this->getMassactionBlock()->addItem("remove_slide", array(
            "label" => Mage::helper("slide")->__("Remove"),
            "url" => $this->getUrl("*/adminhtml_slide/massRemove"),
            "confirm"  => Mage::helper("slide")->__("Are you sure?")
        ));
        $this->getMassactionBlock()->addItem("status", array(
            "label" =>Mage::helper("slide")->__("Status"),
            "url" =>$this->getUrl("*/adminhtml_slide/massSattus"),
            "confirm" => Mage::helper("slide")->__("Are you sure?")
        ));
    }



    static public function getOptionArray5()
    {
        $data_array=array();
        $data_array[1]='Enable';
        $data_array[0]='Disable';
        return($data_array);
    }

    static public function getValueArray5()
    {
        $data_array=array();
        foreach(Magento_Slide_Block_Adminhtml_Slide_Grid::getOptionArray5() as $k=>$v){
            $data_array[]=array('value'=>$k,'label'=>$v);
        }
        return($data_array);

    }
}