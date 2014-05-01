<?php
class Store_Address_IndexController extends Mage_Core_Controller_Front_Action
{
  public function indexAction()
  {
   	$this->loadLayout();

     $this->getLayout()->getBlock("head")->setTitle($this->__("Location"));
          $breadcrumbs = $this->getLayout()->getBlock("address");
          
      // $breadcrumbs->addCrumb("home", array(
      //           "label" => $this->__("Home Page"),
      //           "title" => $this->__("Home Page"),
      //           "link"  => Mage::getBaseUrl()
      //  ));

      // $breadcrumbs->addCrumb("address", array(
      //           "label" => $this->__("Registration"),
      //           "title" => $this->__("Registration")
      //  ));



    $this->renderLayout();
  }
    
	public function saveAction() 
	{
		$id = (int) $this->getRequest()->getParam('id');

  	if($id != '')
		{

		}
		else
		{
  			//SAVE NEW DATA
        $title = ''.$this->getRequest()->getPost('title');
        $description = ''.$this->getRequest()->getPost('description');
        //$image = ''.$this->getRequest()->getPost('fileinputname');


        //on verifie que les champs ne sont pas vide
        //START IMAGE UPLOAD WORK


        if(isset($_FILES['fileinputname']['name']) and (file_exists($_FILES['fileinputname']['tmp_name']))) 
        {
          try {
            $uploader = new Varien_File_Uploader('fileinputname');
            $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png')); // or pdf or anything
         
         
            $uploader->setAllowRenameFiles(false);
         
            // setAllowRenameFiles(true) -> move your file in a folder the magento way
            // setAllowRenameFiles(true) -> move your file directly in the $path folder
            $uploader->setFilesDispersion(false);
           
            $path = Mage::getBaseDir('media') . DS ;
            // $appRoot= Mage::getRoot();
            // $path = $appRoot.DS.'code'.DS.'local'.DS.'Excellence'.DS.'Test'.DS.'image'.DS;


            $uploader->save($path, $_FILES['fileinputname']['name']);
         
            $data['fileinputname'] = $_FILES['fileinputname']['name'];
          }catch(Exception $e) {
         
          }
        }
        // END OF IMAGE UPLOAD WORK
     
         $image = $data['fileinputname'];
     
        /*************************/

        if(isset($title)&&($title!='') && isset($description)&&($description!='') )
        {
          //on cree notre objet et on l'enregistre en base
          $contact = Mage::getModel('test/test');
          $contact->setData('title', $title);
          $contact->setData('description', $description);
          $contact->setData('image', $image);

          $contact->save();
          Mage::getSingleton('core/session')->addSuccess('Records saved successfully!');

            $url = Mage::getUrl('*/*');
            if ($_SERVER['HTTPS'] == 'on') {
                  $url = str_replace('http:', 'https:', $url);
            }
        }
		}
       	$this->_redirect('test/index/new');
    }
    public function editAction()
    {
    	  $this->loadLayout();
        $this->renderLayout();
      	$id = (int) $this->getRequest()->getParam('id');
      	$data = Mage::getModel('test/test');
        $data->load($id);
        $records = $data->getData();
        return $retour;

    }
	  public function newAction()
    {	
      	$this->loadLayout();
        $this->renderLayout();
    }
 	  public function deleteAction() {
  		    $id = (int) $this->getRequest()->getParam('id');
       		$model = Mage::getModel('test/test');
	     		$model->setId($id)->delete();
          $url = Mage::getUrl('*/*');
          if ($_SERVER['HTTPS'] == 'on') {
                $url = str_replace('http:', 'https:', $url);
          }
          $message = $this->__('Record Deleted successfully!');
          Mage::getSingleton('core/session')->addNotice($message); 
          $this->_redirectReferer($url);
    }



      public function stateAction() {
           $url = Mage::getUrl('*/*');
           if ($_SERVER['HTTPS'] == 'on') {
              $url = str_replace('http:', 'https:', $url);
           }

           $countrycode = $this->getRequest()->getParam('country');
           $state = "";
           if ($countrycode != "") 
           {
             $statearray = Mage::getModel('directory/region')->getResourceCollection() ->addCountryFilter($countrycode)->load();
              foreach ($statearray as $_state) 
              {
                $stcode = $_state->getCode();
                $url1 = $url.'address/t/'.$stcode;
             
                if($_state->getDefaultName() != '')
                {
                    $heading = "<a href='javascript:void(0);' style='text-decoration:none;' onclick=hidestate('".$countrycode."'); ><h1>".$this->__('State Listings') ."</h1></a>";
                }
                    $state .= "<tr><td><a href='javascript:void(0);' id='state".$stcode."' onclick=loadaddress('".$url1."','".$stcode."'); ><option value='" . $_state->getCode() . "'>" . $_state->getDefaultName() . "</option></a></td><td><div id='addrid".$stcode."' style='padding-left:200px;width:200px;'></div><div style='padding-left:200px;width:200px;' id='addrid1".$stcode."' > </div></td><tr>";
              }
                $state .= "</table>";
            }
            echo $heading;
            echo $state;
      }


      public function addressAction() {
          $url = Mage::getUrl('*/*');
          if ($_SERVER['HTTPS'] == 'on') {
                $url = str_replace('http:', 'https:', $url);
          }
          $stdcd =  $this->getRequest()->getParam('t');
          $url1 = $url.$stdcd;
          $addr = Mage::getModel('store/address')->getCollection()->addFieldToFilter('state',$stdcd);
          $statesArray = $addr->getData();
          if ($addr != "") {
             $Address =  "";
             if(!empty($statesArray))
             {
              $Address .=  "<a href='javascript:void(0);' style='text-decoration:none;' onclick=hideaddress('".$stdcd."'); ><h1>".$this->__('Address Listings') ."</h1></a>";
             }
             foreach ($statesArray as $addrs) {
               $Address .= "<b> - ".$addrs['address']."</b></br>";
             }
          }
            echo $Address;
      }
}
?>

<script type="text/javascript">

    function loadaddress(url,stcd)
    {
        var reloadurl = url;
        new Ajax.Request(reloadurl, {
        method: 'get',
        onLoading: function (state_form) {
            // $.blockUI(
            //         {
            //             message: '<div class="spinner"><div class="dot1"></div><div class="dot2"></div></div>',
            //         });
            // setTimeout($.unblockUI, 2000);
          
             $.blockUI(
                    {
                        message: '<div class="spinner"><div class="dot1"></div><div class="dot2"></div></div>',
                        baseZ: 10000,
                        fadeIn: 0,
                        fadeOut: 0,
                        css: {},
                        overlayCSS: {
                                    backgroundColor:    '#000000',
                                    opacity:            0.9,
                                    cursor:             'wait'
                        },
                        blockMsgClass: 'blocked',
                        onBlock: function () {
                            // var $blockOverlay = jQuery('.blockUI.blockOverlay').not('.has-spinner');
                            // var $blockMsg = $blockOverlay.next('.blocked');
                            // $blockOverlay.addClass('has-spinner');
                            // new Spinner().spin($blockMsg.get(0));
                        }      
                    });


        },
        onComplete: function(state_form) {
           $.unblockUI();
           jQuery('#addrid'+stcd).html(state_form.responseText);
        }
        });
    }






    function hidestate(stcd)
    {
        jQuery('#state'+stcd).html('');
    }

    function hideaddress(aid)
    {
         jQuery('#addrid'+aid).html('');
    }
</script>