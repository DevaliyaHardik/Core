<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Customer extends Controller_Core_Action{

	public function gridAction()
	{
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

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
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

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
			$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
			throw new Exception("Error Processing Request", 1);			
		}
		if(!(int)$customerId){
			$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
			throw new Exception("Error Processing Request", 1);			
		}
		$customer = $customerModel->load($customerId);
		$address = $addressModel->load($customerId);
		if(!$customer){
			$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
			throw new Exception("Error Processing Request", 1);			
		}

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

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
				$this->getMessage()->addMessage('Your data con not be updated', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			$postData = $request->getPost('customer');
			$customerData = $customerModel->setData($postData);

			if(!empty($customerId)){
				$customerData->customer_id = $customerId;
				$customerData->updatedDate = date("Y-m-d h:i:s");					;
				$customer = $customerModel->save();
				
				if(!$customer){
					$this->getMessage()->addMessage('Your data con not be updated', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);			
				}
				$this->getMessage()->addMessage('Your Data Updated Successfully');
			}
			else{
				$customerData->createdDate = date("Y-m-d h:i:s");					;
				$customerId = $customerModel->save();

				if(!$customerId){
					$this->getMessage()->addMessage('Your data con not be saved', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);			
				}
				$this->getMessage()->addMessage('Your Data Save Successfully');
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
					$this->getMessage()->addMessage('Your data con not be updated', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);			
				}
				$this->getMessage()->addMessage('Your Data Updated Successfully');
			}
			else{
				$addressData->customer_id = $customerId;
				$result = $addressModel->save('address_id');
				if(!$result){
					$this->getMessage()->addMessage('Your data con not be saved', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);			
				}
				$this->getMessage()->addMessage('Your Data Save Successfully');
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
					$this->getMessage()->addMessage('Your data con not be inserted', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);			
				}
				if(!empty($request->getPost('address')['address'])){
					$result = $this->saveAddress($customerId);
					if(!$result){
						$this->getMessage()->addMessage('Your data con not be updated', Model_Core_Message::MESSAGE_ERROR);
						throw new Exception("Error Processing Request", 1);			
					}
					}
					$this->redirect('grid','customer',[],true);
				} catch (Exception $e) {
				$this->redirect('grid','customer',[],true);
			}
	}

	public function deleteAction()
	{
		$deleteModel = Ccc::getModel('Customer');
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					$this->getMessage()->addMessage('Your Data can not be Deleted', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);			
				}
				$customerId=$request->getRequest('id');
				$result = $deleteModel->load($customerId)->delete();
				if(!$result){
					$this->getMessage()->addMessage('Your Data can not be Deleted', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);			
				}
				$this->getMessage()->addMessage('Your Data Delete Successfully');
				$this->redirect('grid','customer',[],true);

			} catch (Exception $e) {
				$this->redirect('grid','customer',[],true);
			}	
		}
	}

}

?>