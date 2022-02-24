<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php

class Controller_Admin extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Admin_Grid')->toHtml();
	}

	public function addAction()
	{
		Ccc::getBlock('Admin_Add')->toHtml();
	}

	public function editAction()
	{
		$adminModel = Ccc::getModel("Admin");
		$request = $this->getRequest();
		$adminId = $request->getRequest('id');
		if(!$adminId){
			throw new Exception("Id is not valid", 1);
		}
		if(!(int)$adminId){
			throw new Exception("Invalid request", 1);
		}
		$admin = $adminModel->fetchRow("SELECT * FROM `admin` WHERE `admin_id` = '$adminId'");
		if(!$admin){
			throw new Exception("System is unable to fine recored", 1);
		}
		Ccc::getBlock("Admin_Edit")->addData('admin',$admin)->toHtml();
	}

	public function saveAction()
	{
		try{
			$request = $this->getRequest();
			if($request->isPost()){
				$row = $request->getPost('admin');
				if(!$request->getPost('submit')){
					throw new Exception("Invalid Request", 1);	
				}
				if($request->getPost('submit') == 'edit'){
					$adminId = $request->getRequest('id');
					$row['updatedDate'] = date("Y-m-d h:i:s");					;
					$edit = Ccc::getModel('Admin');
					$admin = $edit->update($row,$adminId);
					
					if(!$admin){
						echo $e->getMessage();
					}
				}
				else{
					$row['createdDate'] = date("Y-m-d h:i:s");
					$add = Ccc::getModel('Admin');
					$adminId = $add->insert($row);
					
					if(!$adminId){
						echo $e->getMessage();
					}
					
				}
			}
			$this->redirect($this->getView()->getUrl('admin','grid'));
		}
		catch(Exception $e){
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
				$admin_id=$request->getRequest('id');
				$delete =new Model_Core_Adapter();
				$result=$delete->delete("DELETE FROM `admin` WHERE `admin_id` = '$admin_id'");
				if(!$result){
					throw new Exception("System is unable to delete data.", 1);	
				}
				$this->redirect("index.php?c=admin&a=grid");

			} catch (Exception $e) {
				echo $e->getMessage();
			}	
		}
	}


}

?>