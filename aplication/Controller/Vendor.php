<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Vendor extends Controller_Core_Action{

    public function gridAction()
    {
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$header->addChild($menu);

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
		$header->addChild($menu);

		$content = $this->getLayout()->getContent();
		$vendorEdit = Ccc::getBlock('Vendor_Edit')->addData('vendor',$vendor)->addData('address',$address);
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
		$header->addChild($menu);

		$content = $this->getLayout()->getContent();
		$vendorEdit = Ccc::getBlock('Vendor_Edit')->addData('vendor',$vendor)->addData('address',$address);
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
                throw new Exception("Invalid Request", 1);
            }
            $postData = $request->getPost('vendor');
            $vendorData = $vendorModel->setData($postData);

            if(!empty($vendorId)){
                $vendorData->vendor_id = $vendorId;
                $vendorData->updatedDate = date('Y-m-d h:i:s');

                $result = $vendorModel->save();
                if(!$result){
                    throw new Exception("System is unabel to update your data", 1);
                }
            }
            else{
                $vendorData->createdDate = date('Y-m-d h:i:s');
                $vendorId = $vendorModel->save();
                if(!$vendorId){
                    throw new Exception("System is unabel to insert your data", 1);
                }
            }
            return $vendorId;
        }
    }

    public function saveAddress($vendorId)
    {
        $addressModel = Ccc::getModel('Vendor_Address');
        $request = $this->getRequest('id');
        if($request->isPost()){
            if(!$request->getPost('address')){
                throw new Exception("Invalid request", 1);
            }
            $postData = $request->getPost('address');
            $addressData = $addressModel->setData($postData);

            $address = $addressModel->fetchRow("SELECT * FROM `vendor_address` WHERE `vendor_id` = '$vendorId'");
            if($address){
                $addressData->vendor_id = $vendorId;
                $result = $addressModel->save();
            }
            else{
                $addressData->vendor_id = $vendorId;
                $result = $addressModel->save('address_id');
            }
            return $result;
        }
    }

    public function saveAction()
    {
		try {
            $request = $this->getRequest();
            $vendorId = $this->saveVendor();
            if(!$vendorId){
                throw new Exception("System is unabel to insert your data", 1);
            }
            if(!empty($request->getPost('address')['address'])){
                $result = $this->saveAddress($vendorId);
                if(!$result){
                    throw new Exception("System is unabel to insert your data", 1);
                }
                }
            $this->redirect(Ccc::getBlock('Vendor_Grid')->getUrl('grid','vendor',[],true));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    
    }

    public function deleteAction()
    {
        $request = $this->getRequest();
        $vendorModel = Ccc::getModel('Vendor');
        if(!$request->isPost()){
            try {
				if(!$request->getRequest('id')){
					throw new Exception("System is unable to delete your data",1);
				}
				$vendorId=$request->getRequest('id');
				$result = $vendorModel->load($vendorId)->delete();
				if(!$result){
					throw new Exception("System is unable to delete data.", 1);	
				}
				$this->redirect(Ccc::getBlock('Vendor_Grid')->getUrl('grid','vendor',[],true));

			} catch (Exception $e) {
				echo $e->getMessage();
			}	
        }
    }

}