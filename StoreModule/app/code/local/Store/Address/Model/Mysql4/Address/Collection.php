<?php
class Store_Address_Model_Mysql4_Address_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
 {
     public function _construct()
     {
         parent::_construct();
         $this->_init('store/address');
     }
}