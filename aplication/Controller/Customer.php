<?php

class Controller_Customer{

	public function gridAction()
	{
		require_once('view/customer/grid.php');
	}

	protected function saveCustomer()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$firstName = $_POST['customer']['firstName'];
			$lastName = $_POST['customer']['lastName'];
			$email = $_POST['customer']['email'];
			$mobile = $_POST['customer']['mobile'];
			$status = $_POST['customer']['status'];
			if(!isset($_POST['submit'])){
				throw new Exception("Invalid Request", 1);	
			}
			if($_POST['submit'] == 'edit'){
				$customerId = $_GET['id'];
				$date = date('y-m-d h:m:s');
				$edit = new Model_Core_Adapter();
				$customer = $edit->update("UPDATE `customer` 
										   SET `firstName` = '$firstName',`lastName` = '$lastName',`email` = '$email',`mobile` = '$mobile', `status` = '$status',`updatedDate` = '$date' 
										   WHERE `customer_id` = '$customerId'");
				
				if(!$customer){
					echo $e->getMessage();
				}
			}
			else{
				$date = date('Y-m-d h:m:s');
				$add = new Model_Core_Adapter();
				$customerId = $add->insert("INSERT INTO `customer` (`firstName`,`lastName`,`email`,`mobile`,`status`,`createdDate`) 
										VALUES ('$firstName','$lastName','$email','$mobile','$status','$date')");
				
				if(!$customerId){
					echo $e->getMessage();
				}
				
			}
		}
		return $customerId;

	}

	protected function saveAddress($customerId)
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$customerId = $customerId;
			$address1 = $_POST['address']['address1'];
			$city = $_POST['address']['city'];
			$state = $_POST['address']['state'];
			$postalCode = $_POST['address']['postalCode'];
			$country = $_POST['address']['country'];
			$biling = 2;
			$shiping = 2;
			if(!empty($_POST['address']['biling'])){
				$biling = 1;
			}
			if(!empty($_POST['address']['shiping'])){
				$shiping = 1;
			}
			if(!isset($_POST['submit'])){
				throw new Exception("Invalid Request", 1);	
			}
			if($_POST['submit'] == 'edit'){
				$date = date('y-m-d h:m:s');
				$edit = new Model_Core_Adapter();

				$address = $edit->update("UPDATE `address` 
										 SET `address1` = '$address1',
											  `city` = '$city',
											  `state` = '$state',
											  `postalCode` = '$postalCode',
											  `country` = '$country',
											  `biling` = '$biling',
											  `shiping` = '$shiping' 
										 WHERE `customer_id` = '$customerId'");

				if(!$address){
					throw new Exception("System is unable to save data.", 1);	
				}
			}
			else{
				$date = date('Y-m-d h:m:s');
				$add = new Model_Core_Adapter();
				$result = $add->insert("INSERT INTO `address` (`customer_id`,`address1`,`city`,`state`,`postalCode`,`country`,`biling`,`shiping`)
										 VALUES ('$customerId','$address1','$city','$state','$postalCode','$country','$biling','$shiping')");

				if(!$result){
					throw new Exception("System is unable to save data.", 1);	
				}

			}
		}
	}

	public function saveAction()
	{
		try {
				$customerId = $this->saveCustomer();
				if(empty($_POST['address'])){
					throw new Exception("address not mendetary", 1);
				}
				$this->saveAddress($customerId);
				
				$this->redirect("index.php?c=customer&a=grid");
			} catch (Exception $e) {
				echo $e->getMessage();
			}
	}

	public function editAction()
	{
		require_once('view/customer/edit.php');
	}

	public function addAction()
	{
		require_once('view/customer/add.php');
	}

	public function deleteAction()
	{
		if($_SERVER['REQUEST_METHOD']=='GET'){
			try {
				if(!isset($_GET['id'])){
					throw new Exception("System is unable to delete your data",1);
				}
				$customer_id=$_GET['id'];
				$delete =new Model_Core_Adapter();
				$result=$delete->delete("DELETE FROM `customer` WHERE `customer_id` = '$customer_id'");
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