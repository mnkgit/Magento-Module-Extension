<?php
class Store_Address_Block_Adminhtml_Address_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
   protected function _prepareForm()
   {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('state_form',
                                       array('legend'=>'Store Address Information'));



      $fieldset->addField('address', 'text',
                     array(
                        'label' => 'Address',
                        'class' => 'required-entry',
                        'required' => true,
                         'name' => 'address',
                  ));




      $country = $fieldset->addField('country', 'select', array(
      'name'  => 'country',
      'label'     => 'Country',
      'values'    => Mage::getModel('adminhtml/system_config_source_country') ->toOptionArray(),
      'onchange' => 'getstate(this)',
      ));
 
      $fieldset->addField('state', 'select', array(
      'name'  => 'state',
      'label'     => 'State',
      'values'    => Mage::getModel('store/address')->getstate('AU'),
      ));



      /*
      * Add Ajax to the Country select box html output
      */
      $country->setAfterElementHtml("<script type=\"text/javascript\">
            function getstate(selectElement){
                var reloadurl = '". $this
                 ->getUrl('address/adminhtml_address/state') . "country/' + selectElement.value;
                new Ajax.Request(reloadurl, {
                    method: 'get',
                    onLoading: function (state_form) {
                        $('state').update('Searching...');
                    },
                    onComplete: function(state_form) {
                        $('state').update(state_form.responseText);
                    }
                });
            }
      </script>");




      $note = "enble / disable";
      $fieldset->addField('status', 'select', array(
                    'name'      => 'status',
                    'label'     => "Status",
                    'title'     => "Status",
                    'required'  => true,
                    'note'      => $note,
                    'values'    => array('0' => array( 'value' => 0, 'label' => Enable ),
'1' => array( 'value' => 1, 'label' => Disable )),
              ));


      $fieldset->addField('sort', 'text',
                     array(
                        'label' => 'Sort Order',
                      //  'class' => 'required-entry',
                      //  'required' => true,
                         'name' => 'sort',
                  ));
        
      if(Mage::registry('state_data'))
      {
          $form->setValues(Mage::registry('state_data')->getData());
      }

    return parent::_prepareForm();
  }
}