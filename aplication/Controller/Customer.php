<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Customer extends Controller_Core_Action{

	public function gridAction()
	{
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$header->addChild($menu);

		$content = $this->getLayout()->getContent();
		$customerGrid = Ccc::getBlock('Customer_Grid');
		$content->addChild($customerGrid);

		$this->randerLayout();
	}

	public function addAction()
	{
		$customerModel = Ccc::getModel("Customer");
		$customer = $customerModel;
		$address = $customerModel;

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$header->addChild($menu);

		$content = $this->getLayout()->getContent();
		$customerEdit = Ccc::getBlock('Customer_Edit')->addData('customer',$customer)->addData('address',$address);
		$content->addChild($customerEdit);

		$this->randerLayout();
	}

	public function editAction()
	{
		$customerModel = Ccc::getModel("Customer");
		$addressModel = Ccc::getModel("Customer_Address");
		$request = $this->getRequest();
		$customerId = $request->getRequest('id');
		if(!$customerId){
			throw new Exception("Id is not valid", 1);
		}
		if(!(int)$customerId){
			throw new Exception("Invalid request", 1);
		}
		$customer = $customerModel->load($customerId);
		$address = $addressModel->load($customerId);
		if(!$customer){
			throw new Exception("System is unable to fine recored", 1);
		}

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$header->addChild($menu);

		$content = $this->getLayout()->getContent();
		$customerEdit = Ccc::getBlock('Customer_Edit')->addData('customer',$customer)->addData('address',$address);
		$content->addChild($customerEdit);

		$this->randerLayout();
	}

	protected function saveCustomer()
	{
		$customerModel = Ccc::getModel('Customer');
		$request = $this->getRequest();
		$customerId = $request->getRequest('id');
		if($request->isPost()){
			if(!$request->getPost()){
				throw new Exception("Invalid Request", 1);	
			}
			$postData = $request->getPost('customer');
			$customerData = $customerModel->setData($postData);

			if(!empty($customerId)){
				$customerData->customer_id = $customerId;
				$customerData->updatedDate = date("Y-m-d h:i:s");					;
				$customer = $customerModel->save();
				
				if(!$customer){
					echo $e->getMessage();
				}
			}
			else{
				$customerData->createdDate = date("Y-m-d h:i:s");					;
				$customerId = $customerModel->save();

				if(!$customerId){
					echo $e->getMessage();
				}
				
			}
		}
		return $customerId;

	}

	protected function saveAddress($customerId)
	{
		$addressModel = Ccc::getModel('Customer_Address');
		$request = $this->getRequest();

		if($request->isPost()){
			$customerId = $customerId;
			$postData = $request->getpost('address');
			$postData['biling'] = !empty($postData['biling']) ? '1' : '2';
			$postData['shiping'] = !empty($postData['shiping']) ? '1' : '2';
			$addressData = $addressModel->setData($postData);
			$address = $addressModel->fetchRow("SELECT * FROM `customer_address` WHERE `customer_id` = '$customerId'");
			if($address){
				$addressData->customer_id = $customerId;
				$result = $addressModel->save();
				if(!$result){
					throw new Exception("System is unable to save data.", 1);	
				}
			}
			else{
				$addressData->customer_id = $customerId;
				$result = $addressModel->save('address_id');
				if(!$result){
					throw new Exception("System is unable to save data.", 1);	
				}

			}
			return $result;
		}
	}

	public function saveAction()
	{
		try {
				$request = $this->getRequest();
				$customerId = $this->saveCustomer();
				if(!$customerId){
					throw new Exception("System is unabel to insert your data", 1);
				}
				if(!empty($request->getPost('address')['address'])){
					$result = $this->saveAddress($customerId);
					if(!$result){
						throw new Exception("System is unabel to insert your data", 1);
					}
					}
				$this->redirect(Ccc::getBlock('Customer_Grid')->getUrl('grid','customer',[],true));
			} catch (Exception $e) {
				echo $e->getMessage();
			}
	}

	public function deleteAction()
	{
		$deleteModel = Ccc::getModel('Customer');
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					throw new Exception("System is unable to delete your data",1);
				}
				$customerId=$request->getRequest('id');
				$result = $deleteModel->load($customerId)->delete();
				if(!$result){
					throw new Exception("System is unable to delete data.", 1);	
				}
				$this->redirect(Ccc::getBlock('Customer_Grid')->getUrl('grid','customer',[],true));

			} catch (Exception $e) {
				echo $e->getMessage();
			}	
		}
	}

}

?>