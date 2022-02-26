<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php

class Controller_Admin extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Admin_Grid')->toHtml();
	}

	public function addAction()
	{
		$adminModel = Ccc::getModel('Admin');
		$admin = $adminModel;
		Ccc::getBlock("Admin_Edit")->addData('admin',$admin)->toHtml();
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
		$admin = $adminModel->load($adminId);
		if(!$admin){
			throw new Exception("System is unable to fine recored", 1);
		}
		Ccc::getBlock("Admin_Edit")->addData('admin',$admin)->toHtml();
	}

	public function saveAction()
	{
		try{
			$adminModel = Ccc::getModel('Admin');
			$request = $this->getRequest();
			$adminId = $request->getRequest('id');
			if($request->isPost()){
				$postData = $request->getPost('admin');
				if(!$postData)
				{
					throw new Exception("Invalid data posted.", 1);	
				}

				$adminData = $adminModel->setData($postData);

				if(!empty($adminId)){
					$adminData->admin_id = $adminId;
					$adminData->updatedDate = date("Y-m-d h:i:s");					;
					$admin = $adminModel->save();
					
					if(!$admin){
						throw new Exception("System is unable to edit your data.", 1);	
					}
				}
				else{
					unset($adminData->admin_id);
					$adminData->createdDate = date("Y-m-d h:i:s");
					$adminId = $adminModel->save();
					
					if(!$adminId){
						throw new Exception("System is unable to insert your data.", 1);	
					}
					
				}
			}
			$this->redirect($this->getView()->getUrl('grid','admin',[],true));
		}
		catch(Exception $e){
			echo $e->getMessage();			
		}

	}

	public function deleteAction()
	{
		$adminModel = Ccc::getModel('Admin');
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					throw new Exception("System is unable to delete your data",1);
				}
				$adminId = $request->getRequest('id');
				$result = $adminModel->load($adminId)->delete();
				if(!$result){
					throw new Exception("System is unable to delete data.", 1);	
				}
				$this->redirect($this->getView()->getUrl('grid','admin',[],true));

			} catch (Exception $e) {
				echo $e->getMessage();
			}	
		}
	}


}

?>