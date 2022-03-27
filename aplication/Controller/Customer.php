<?php Ccc::loadClass('Controller_Admin_Action') ?>
<?php

class Controller_Customer extends Controller_Admin_Action{

	public function __construct()
	{
		$this->setTitle('Customer');
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
		$customerEdit = Ccc::getBlock('Customer_Edit');
		Ccc::register('customer',$customer);
		Ccc::register('bilingAddress',$address);
		Ccc::register('shipingAddress',$address);
	$content->addChild($customerEdit);

		$this->randerLayout();
	}

	public function editAction()
	{
		try {
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
			$bilingAddress = $customer->getBilingAddress();
			$shipingAddress = $customer->getShipingAddress();
			if(!$customer){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
	
			$header = $this->getLayout()->getHeader();
			$menu = Ccc::getBlock('Core_Layout_Header_Menu');
			$message = Ccc::getBlock('Core_Layout_Header_Message');
			$header->addChild($menu)->addChild($message);
	
			$content = $this->getLayout()->getContent();
			$customerEdit = Ccc::getBlock('Customer_Edit');
			Ccc::register('customer',$customer);
			Ccc::register('bilingAddress',$bilingAddress);
			Ccc::register('shipingAddress',$shipingAddress);
			$content->addChild($customerEdit);
	
			$this->randerLayout();
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('grid','customer');
		}	
	}

	protected function saveCustomer()
	{
		$customerModel = Ccc::getModel('Customer');
		$request = $this->getRequest();
		$customerId = $request->getRequest('id');
		if($request->isPost()){
			if(!$request->getPost()){
				throw new Exception('Your data con not be updated', 1);			
			}
			$postData = $request->getPost('customer');
			$customerData = $customerModel->setData($postData);
			if(!empty($customerId)){
				$customerData->customer_id = $customerId;
				$customerData->updatedDate = date("Y-m-d h:i:s");					;
			}
			else{
				$customerData->createdDate = date("Y-m-d h:i:s");					;
			}
			$customer = $customerModel->save();

			if(!$customer){
				throw new Exception('Your data con not be saved', 1);			
			}
			$this->getMessage()->addMessage('Your Data Save Successfully');

		}
		return $customer;

	}

	protected function saveAddress($customer = null)
	{
		$request = $this->getRequest();
		$customerId = $request->getRequest('id');
		if(!$customer){
			$customer = Ccc::getModel('Customer')->load($customerId);
		}
		$addressModel = Ccc::getModel('Customer_Address');
		if($request->isPost()){
			$postBiling = $request->getPost('bilingAddress');
			$postShiping = $request->getPost('shipingAddress');
			$biling = $customer->getBilingAddress();
			$shiping = $customer->getShipingAddress();
			if($postBiling){
				$biling->setData($postBiling);
			}
			$biling->customer_id = $customer->customer_id;
			$biling->biling = 1;
			$biling->shiping = 2;
			if($postShiping){
				$shiping->setData($postShiping);	
			}
			$shiping->customer_id = $customer->customer_id;
			$shiping->biling = 2;
			$shiping->shiping = 1;
			$save = $biling->save();
			if(!$save){
				throw new Exception('Customer Details Not Saved.', 1);
			}
			$save = $shiping->save();
			if(!$save){
				throw new Exception('Customer Details Not Saved.', 1);
			}
			return $save;
		}
	}

	public function saveAction()
	{
		try {
				$request = $this->getRequest();
				if($request->getPost('customer')){
					$customer = $this->saveCustomer();
					if(!$customer){
						throw new Exception('Your data con not be inserted', 1);			
					}
					$address = $this->saveAddress($customer);
				}
				if($request->getPost('bilingAddress') || $request->getPost('shipingAddress')){
					$address = $this->saveAddress();
					if(!$address){
						throw new Exception('Your data con not be updated', 1);			
					}
				}
				$this->redirect('grid',null,['id' => null,'tab' => null]);
			}catch (Exception $e){
				$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
				$this->redirect('grid','customer',['id' => null,'tab' => null]);
			}	
		}

	public function deleteAction()
	{
		$deleteModel = Ccc::getModel('Customer');
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					throw new Exception('Your Data can not be Deleted', 1);			
				}
				$customerId=$request->getRequest('id');
				$result = $deleteModel->load($customerId)->delete();
				if(!$result){
					throw new Exception('Your Data can not be Deleted', 1);			
				}
				$this->getMessage()->addMessage('Your Data Delete Successfully');
				$this->redirect('grid',null,['id' => null]);

			}catch (Exception $e){
				$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
				$this->redirect('grid','customer',['id' => null]);
			}	
		}
	}

}

?>