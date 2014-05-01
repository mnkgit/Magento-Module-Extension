<?php
class Store_Address_Model_Mysql4_Address extends Mage_Core_Model_Mysql4_Abstract
{
     public function _construct()
     {
         $this->_init('store/address', 'id');
     }
}