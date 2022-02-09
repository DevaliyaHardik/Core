<?php
class Controller_Category{

	public function gridAction()
	{
		//echo "111";
		require_once('view/category/grid.php');
	}

	public function saveAction()
	{
		try {
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$parentId = $_POST['category']['parentId'];
				$name = $_POST['category']['name'];
				$status = $_POST['category']['status'];
				$date = date('y-m-d h:m:s');
				if(!isset($_POST['submit'])){
					throw new Exception("Invalid Request", 1);
				}
				if($_POST['submit'] == 'edit'){
					$categoryId = $_GET['id'];
					$edit = new Model_Core_Adapter();
					$result = $edit->update("UPDATE `category` SET `name` = '$name', `status` = '$status',`updatedDate` = '$date' WHERE `category_id` = '$categoryId'");
					if(!$result){
						throw new Exception("Sysetm is unable to save your data", 1);	
					}
					$this->redirect("index.php?c=category&a=grid");
				}
				else{
					$add = new Model_Core_Adapter();
					if(empty($parentId)){
						$result = $add->insert("INSERT INTO `category` (`name`,`status`,`createdDate`) VALUE ('$name','$status','$date')");
					}
					else{
						$result = $add->insert("INSERT INTO `category` (`parent_id`,`name`,`status`,`createdDate`) VALUE ('$parentId','$name','$status','$date')");
					}
					if(!$result){
						throw new Exception("Sysetm is unable to save your data", 1);	
					}
					$this->redirect("index.php?c=category&a=grid");
				}
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function editAction()
	{
		require_once('view/category/edit.php');
	}

	public function addAction()
	{
		require_once('view/category/add.php');
	}

	public function deleteAction()
	{
		try {
			if(!isset($_GET['id'])){
				throw new Exception("Invalid Request", 1);
			}
		    $category_id = $_GET['id'];
		    $delete = new Model_Core_Adapter();
		    $result = $delete->delete("DELETE FROM `category` WHERE `category_id`='$category_id'");
		    if(!$result){
				throw new Exception("System is unable to delete data.", 1);
		    }
			$this->redirect("index.php?c=category&a=grid");
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