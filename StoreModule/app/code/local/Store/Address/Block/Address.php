<?php



class Store_Address_Block_Address extends Mage_Core_Block_Template
{
   protected function _construct()
   {
      

      parent::_construct();
      $this->setTemplate('address/test1.phtml');
   }

   public function methodinblock()
   {
        $retour=array();
        $collection = Mage::getModel('store/address')->getCollection()->setOrder('id','asc');
        $s=0;
        foreach($collection as $data)
        {
             $retour[$s][] = $data->getData('id');
             $retour[$s][] = $data->getData('address');
             $retour[$s][] = $data->getData('state');
             $retour[$s][] = $data->getData('country');


          $s++;
        }
        return $retour;
   }
   public function formtest()
   {
      // $id = (int) $this->getRequest()->getParam('id');
      // $model = Mage::getModel('test/test');
      // $model->load($id);
      // $data = $model->getData();
      // return $data;
   }










   



  
}

?>