<?php

class Controller_Product{

	public function gridAction()
	{
		//echo "111";
		require_once('view/product/grid.php');
	}

	public function saveAction()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$name = $_POST['product']['name'];
			$prize = $_POST['product']['prize'];
			$quntity = $_POST['product']['quntity'];
			$status = $_POST['product']['status'];
			try {
				if(!isset($_POST['submit'])){
					throw new Exception("Invalid Request", 1);	
				}
				if($_POST['submit'] == "edit"){
					$product_id = $_GET['product_id'];			
					$save = new Model_Core_Adapter();
					$date = date('Y-m-d h:i:s');
					$result = $save->update("UPDATE `product` 
										SET `name` = '$name', 
											`prize` = $prize,
											`quntity` = '$quntity',
											`status` = '$status',
											`updatedDate`= '$date' 
										WHERE 
											`product_id` = $product_id");
			
					if(!$result){
						throw new Exception("System is unable to save your data.", 1);
					}
					$this->redirect("index.php?c=product&a=grid");
				}else{
					$add = new Model_Core_Adapter();
					$date = date('Y-m-d h:i:s');
					$result = $add->insert("INSERT INTO `product` (`name`,`prize`,`quntity`,`status`,`createdDate`) 
											VALUE ('$name','$prize','$quntity','$status','$date')");
					if(!$result){
						throw new Exception("System is unable to save your data.", 1);
					}
					$this->redirect("index.php?c=product&a=grid");
				}			
			} catch (Exception $e) {
				echo $e->getMessage();
			}
			
		}
		
	}

	public function editAction()
	{
		require_once('view/product/edit.php');
	}

	public function addAction()
	{
		require_once('view/product/add.php');
	}

	public function deleteAction()
	{
		try {
			if(!isset($_GET['product_id'])){
				throw new Exception("Invalid Request", 1);
			}
			$product_id = $_GET['product_id'];
			$data = new Model_Core_Adapter();
			$result = $data->delete("DELETE FROM `product` WHERE `product_id` = $product_id");
			if(!$result){
				throw new Exception("System is unable to delete data.", 1);
			}
			$this->redirect("index.php?c=product&a=grid");
		} catch (Exception $e) {
			echo $e->getMessage();
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