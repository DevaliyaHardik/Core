<?php Ccc::loadClass('Controller_Admin_Action') ?>
<?php

class Controller_Vendor extends Controller_Admin_Action{

    public function __construct()
	{
        $this->setTitle('Vendor');
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}

    public function gridAction()
    {
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$vendorGrid = Ccc::getBlock('Vendor_Grid');
		$content->addChild($vendorGrid);

        $this->randerLayout();
    }

    public function addAction()
    {
        $vendorModel = Ccc::getModel('Vendor');
        $vendor = $vendorModel;
        $address = $vendorModel;

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$vendorEdit = Ccc::getBlock('Vendor_Edit');
        $vendorEdit->vendor = $vendor;
        $vendorEdit->address = $address;
		$content->addChild($vendorEdit);

        $this->randerLayout();
    }

    public function editAction()
    {
        $vendorModel = Ccc::getModel('Vendor');
        $addressModel = Ccc::getModel('Vendor_Address');
        $request = $this->getRequest();
        $vendorId = $request->getRequest('id');

        $vendor = $vendorModel->load($vendorId);
        $address = $addressModel->load($vendorId);

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$vendorEdit = Ccc::getBlock('Vendor_Edit');
        $vendorEdit->vendor = $vendor;
        $vendorEdit->address = $address;
		$content->addChild($vendorEdit);

        $this->randerLayout();
    }

    public function saveVendor()
    {
        $vendorModel = Ccc::getModel('Vendor');
        $request = $this->getRequest();
        $vendorId = $request->getRequest('id');
        if($request->isPost()){
            if(!$request->getPost('vendor')){
				$this->getMessage()->addMessage('Your data con not be updated', Model_Core_Message::MESSAGE_ERROR);
                throw new Exception("Error Processing Request", 1);
            }
            $postData = $request->getPost('vendor');
            $vendorData = $vendorModel->setData($postData);

            if(!empty($vendorId)){
                $vendorData->vendor_id = $vendorId;
                $vendorData->updatedDate = date('Y-m-d h:i:s');
            }
            else{
                $vendorData->createdDate = date('Y-m-d h:i:s');
            }
            $vendor = $vendorModel->save();
            if(!$vendor){
                $this->getMessage()->addMessage('Your data con not be saved', Model_Core_Message::MESSAGE_ERROR);
                throw new Exception("Error Processing Request", 1);
            }
            $this->getMessage()->addMessage('Your Data Save Successfully');

            return $vendor;
        }
    }

    public function saveAddress($vendor)
    {
        $address = $vendor->getAddress();
        $request = $this->getRequest();
        if($request->isPost()){
            if(!$request->getPost('address')){
                $this->getMessage()->addMessage('Your data con not be updated', Model_Core_Message::MESSAGE_ERROR);
                throw new Exception("Error Processing Request", 1);
            }
            $postData = $request->getPost('address');
            if(!$address->address_id)
            {
                unset($address->address_id);
            }
            $address->setData($postData);
            $address->vendor_id=$vendor->vendor_id;
            $result = $address->save();
            if(!$result){
                $this->getMessage()->addMessage('Your data con not be saved', Model_Core_Message::MESSAGE_ERROR);
                throw new Exception("Error Processing Request", 1);
            }
            $this->getMessage()->addMessage('Your Data Save Successfully');

            return $result;
        }
    }

    public function saveAction()
    {
		try {
            $request = $this->getRequest();
            $vendor = $this->saveVendor();
            if(!$vendor){
                $this->getMessage()->addMessage('Your data con not be inserted', Model_Core_Message::MESSAGE_ERROR);
                throw new Exception("Error Processing Request", 1);
            }
            if(!empty($request->getPost('address')['address'])){
                $result = $this->saveAddress($vendor);
                if(!$result){
                    $this->getMessage()->addMessage('Your data con not be updated', Model_Core_Message::MESSAGE_ERROR);
                    throw new Exception("Error Processing Request", 1);
                }
                }
				$this->redirect('grid',null,['id' => null]);
        } catch (Exception $e) {
            $this->redirect('grid',null,['id' => null]);
        }
    
    }

    public function deleteAction()
    {
        $request = $this->getRequest();
        $vendorModel = Ccc::getModel('Vendor');
        if(!$request->isPost()){
            try {
				if(!$request->getRequest('id')){
					$this->getMessage()->addMessage('Your Data can not be Deleted', Model_Core_Message::MESSAGE_ERROR);
                    throw new Exception("Error Processing Request", 1);
				}
				$vendorId=$request->getRequest('id');
				$result = $vendorModel->load($vendorId)->delete();
				if(!$result){
					$this->getMessage()->addMessage('Your Data can not be Deleted', Model_Core_Message::MESSAGE_ERROR);
                    throw new Exception("Error Processing Request", 1);
				}
				$this->getMessage()->addMessage('Your Data Delete Successfully');
				$this->redirect('grid',null,['id' => null]);

			} catch (Exception $e) {
				$this->redirect('grid',null,['id' => null]);
			}	
        }
    }

}