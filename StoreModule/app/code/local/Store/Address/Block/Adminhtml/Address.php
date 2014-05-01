<?php
class Store_Address_Block_Adminhtml_Address extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
     //where is the controller
     $this->_controller = 'adminhtml_address';
     $this->_blockGroup = 'address';
     //text in the admin header
     $this->_headerText = Mage::helper('address')->__('Address -  Manager');
     //value of the add button
     $this->_addButtonLabel = 'Add New aaaaaaddress';
     parent::__construct();
     }
}