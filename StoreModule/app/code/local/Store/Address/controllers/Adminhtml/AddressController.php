<?php

class Store_Address_Adminhtml_AddressController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout();
        return $this;
    }

      public function indexAction()
      { 
        $this->loadLayout()->_setActiveMenu('address/address');
        $this->_addContent($this->getLayout()->createBlock('address/adminhtml_address'));
        $this->renderLayout();
      }
      public function editAction()
      {
           $testId = $this->getRequest()->getParam('id');
           $testModel = Mage::getModel('store/address')->load($testId);


           if ($testModel->getId() || $testId == 0)
           {
             Mage::register('state_data', $testModel);
             $this->loadLayout();
             $this->_setActiveMenu('address/set_time');
              // $this->_addBreadcrumb('state Manager', 'state Manager **');
              // $this->_addBreadcrumb('state Description', 'state Description ** ');
              // $this->getLayout()->getBlock('head')
              //     ->setCanLoadExtJs(true);
             $this->_addContent($this->getLayout()
                  ->createBlock('address/adminhtml_address_edit'))
                  ->_addLeft($this->getLayout()
                  ->createBlock('address/adminhtml_address_edit_tabs')
              );
             $this->renderLayout();
           }
           else
           {
                 Mage::getSingleton('adminhtml/session')
                       ->addError('Address does not exist');
                 $this->_redirect('*/*/');
            }
       }
       public function newAction()
       {
          $this->_forward('edit');
       }
       public function saveAction()
       {
        if ($this->getRequest()->getPost())
         {

          try {
                $postData = $this->getRequest()->getPost();
                $testModel = Mage::getModel('store/address');
                if($this->getRequest()->getParam('id') <= 0 )
                  $testModel->setCreatedTime(Mage::getSingleton('core/date')->gmtDate());
                  $testModel->addData($postData)->setUpdateTime(Mage::getSingleton('core/date')->gmtDate())->setId($this->getRequest()->getParam('id'))->save();

                  Mage::getSingleton('adminhtml/session')->addSuccess('successfully saved');
                  Mage::getSingleton('adminhtml/session')->settestData(false);
                  $this->_redirect('*/*/');
                return;

          } catch (Exception $e){
                Mage::getSingleton('adminhtml/session')
                                  ->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')
                 ->settestData($this->getRequest()
                                    ->getPost()
                );
                $this->_redirect('*/*/edit',
                            array('id' => $this->getRequest()
                                                ->getParam('id')));
                return;
                }
              }
              $this->_redirect('*/*/');
          }
          


      public function deleteAction()
      {
              if($this->getRequest()->getParam('id') > 0)
              {
                try
                {
                    $testModel = Mage::getModel('store/address');
                    $testModel->setId($this->getRequest()
                                        ->getParam('id'))
                              ->delete();
                    Mage::getSingleton('adminhtml/session')
                               ->addSuccess('successfully deleted');
                    $this->_redirect('*/*/');
                 }
                 catch (Exception $e)
                  {
                           Mage::getSingleton('adminhtml/session')
                                ->addError($e->getMessage());
                           $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                  }
             }
            $this->_redirect('*/*/');
      }




          public function stateAction() {
            $countrycode = $this->getRequest()->getParam('country');
            $state = "<option value=''>Please Select</option>";
            if ($countrycode != "") {
              $statearray = Mage::getModel('directory/region')->getResourceCollection() ->addCountryFilter($countrycode)->load();
                foreach ($statearray as $_state) {
                  $state .= "<option value='" . $_state->getCode() . "'>" . $_state->getDefaultName() . "</option>";
                }
            }
            echo $state;
          }


         


            


}
?>