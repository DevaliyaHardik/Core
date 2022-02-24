<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Customer extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Customer_Grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Customer_Add')->toHtml();
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
		$customer = $customerModel->fetchRow("SELECT * FROM `customer` WHERE `customer_id` = '$customerId'");
		$address = $addressModel->fetchRow("SELECT * FROM `address` WHERE `customer_id` = '$customerId'");
		if(!$customer){
			throw new Exception("System is unable to fine recored", 1);
		}
		Ccc::getBlock("Customer_Edit")->addData('customer',$customer)->addData('address',$address)->toHtml();
	}

	protected function saveCustomer()
	{
		$request = $this->getRequest();
		if($request->isPost()){
			$row = $request->getPost('customer');

			if(!$request->getPost('submit')){
				throw new Exception("Invalid Request", 1);	
			}

			if($request->getPost('submit') == 'edit'){
				$customerId = $request->getRequest('id');
				$edit = Ccc::getModel('Customer');
				$customer = $edit->update($row,$customerId);
				
				if(!$customer){
					echo $e->getMessage();
				}
			}
			else{
				$add = Ccc::getModel('Customer');
				$customerId = $add->insert($row);

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
			$row = $request->getpost('address');
			$row['biling'] = !empty($row['biling']) ? '1' : '2';
			$row['shiping'] = !empty($row['shiping']) ? '1' : '2';
			$address = $addressModel->fetchRow("SELECT * FROM `address` WHERE `customer_id` = '$customerId'");
			if($address){
				$address = $addressModel->update($row,$customerId);
				if(!$address){
					throw new Exception("System is unable to save data.", 1);	
				}
			}
			else{
				$row['customer_id'] = $customerId;
				$result = $addressModel->insert($row);

				if(!$result){
					throw new Exception("System is unable to save data.", 1);	
				}

			}
		}
	}

	public function saveAction()
	{
		try {
				$request = $this->getRequest();
				$customerId = $this->saveCustomer();
				if(empty($request->getPost('address'))){
					throw new Exception("address not mendetary", 1);
				}
				$this->saveAddress($customerId);
				
				$this->redirect("index.php?c=customer&a=grid");
			} catch (Exception $e) {
				echo $e->getMessage();
			}
	}

	public function deleteAction()
	{
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					throw new Exception("System is unable to delete your data",1);
				}
				$customerId=$request->getRequest('id');
				$delete = Ccc::getModel('Customer');
				$result=$delete->delete($customerId);
				if(!$result){
					throw new Exception("System is unable to delete data.", 1);	
				}
				$this->redirect("index.php?c=customer&a=grid");

			} catch (Exception $e) {
				echo $e->getMessage();
			}	
		}
	}

	public function errorAction()
	{
		echo "error";
	}

	public function redirect($location)
	{
		header("location: $location");
	}


}

?>