<?php
class Store_Address_Model_Address extends Mage_Core_Model_Abstract
{
     public function _construct()
     {
         parent::_construct();
         $this->_init('store/address');
     }
     


      public function getRecord()
      {


  //      	$sql = "SELECT address FROM stores_address";
		// $data = Mage::getSingleton('store/address')->getConnection('core_read')->fetchAll($sql);

     // 	 $resource = Mage::getSingleton('store/address')->getConnection('core_read');
    
    // $readConnection = $resource->getConnection('core_read');
    // $writeConnection = $resource->getConnection('core_write');

     


    // $query = 'SELECT * FROM `stores_address` ';

    //  	 $select = $readConnection->select()->from(`stores_address`, array(`address`))->where(`country=`,`US`);

      //	 $products=$read->fetchAll($select);

		 //   $results = $readConnection->fetchAll($query);
    //var_dump($results);



// $resource = Mage::getSingleton('store/address');
// $read = $resource->getConnection('core_read');
// $categoryProductTable= 'stores_address';
// $select = $read->select()->from(array('address'=>$categoryProductTable))->where('cp.country=', 'US');
// echo $select;
// exit;

// $products=$resource->fetchAll($select);


// foreach($products as $row)
// {
// $product = Mage::getModel('store/address')->load($row['product_id']);
// echo $product->getName();
// }
   

			print_r($products);
			exit;


      }

}