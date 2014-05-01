<?php
class Store_Address_Block_Adminhtml_Address_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{
   public function __construct()
   {
        parent::__construct();
        $this->_objectId = 'id';
        //vwe assign the same blockGroup as the Grid Container
        $this->_blockGroup = 'address';
        //and the same controller
        $this->_controller = 'adminhtml_address';
        //define the label for the save and delete button
        $this->_updateButton('save', 'label','Save');
        /*$this->_updateButton('delete', 'label', 'delete reference');*/
    }
       /* Here, we're looking if we have transmitted a form object,
          to update the good text in the header of the page (edit or add) */
    public function getHeaderText()
    {
        if( Mage::registry('state_data')&&Mage::registry('state_data')->getId())
         {  
            return 'Edit: '.$this->htmlEscape(
              Mage::registry('state_data')->getname()).'<br />';
         }
         else
         {
             return 'Create New Address *';
         }
    }
}