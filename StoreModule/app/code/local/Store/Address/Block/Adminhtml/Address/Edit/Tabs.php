<?php
  class Store_Address_Block_Adminhtml_Address_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
  {
     public function __construct()
     {
          parent::__construct();
          $this->setId('state_data');
          $this->setDestElementId('edit_form');
          $this->setTitle('All Address');
      }
      protected function _beforeToHtml()
      {
          $this->addTab('form_section', array(
                   'label' => 'Address Information',
                   'title' => 'Address Information',
                   'content' => $this->getLayout()
     ->createBlock('address/adminhtml_address_edit_tab_form')
     ->toHtml()
         ));
         return parent::_beforeToHtml();
    }
}