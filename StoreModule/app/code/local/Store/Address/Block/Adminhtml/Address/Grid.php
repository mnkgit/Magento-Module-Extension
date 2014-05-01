<?php
class Store_Address_Block_Adminhtml_Address_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
   public function __construct()
   {
       parent::__construct();
       $this->setId('addressGrid');
       $this->setDefaultSort('id');
       $this->setDefaultDir('DESC');
       $this->setSaveParametersInSession(true);
   }
   protected function _prepareCollection()
   {

      $collection = Mage::getModel('store/address')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
    }
   protected function _prepareColumns()
   {
       $this->addColumn('id',
             array(
                    'header' => 'ID',
                    'align' =>'right',
                    'width' => '50px',
                    'index' => 'id',
               ));

       $this->addColumn('address',
               array(
                    'header' => 'Address',
                    'align' =>'left',
                    'index' => 'address',
              ));



       $this->addColumn('state',
               array(
                    'header' => 'State',
                    'align' =>'left',
                    'index' => 'state',
              ));



       $this->addColumn('country',
               array(
                    'header' => 'Country',
                    'align' =>'left',
                    'index' => 'country',
              ));



        $this->addColumn('status',
               array(
                    'header' => 'Status',
                    'align' =>'left',
                    'index' => 'status',
                    'type'      => 'options',
                    'options'    => array('0' => 'Enable','1' => 'Disable')

              ));

        $this->addColumn('sort',
               array(
                    'header' => 'Sort Order',
                    'align' =>'left',
                    'index' => 'sort',
              ));
     
         return parent::_prepareColumns();
    }
    public function getRowUrl($row)
    {
         return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}