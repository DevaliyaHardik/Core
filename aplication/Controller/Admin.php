<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php

class Controller_Admin extends Controller_Core_Action{

	public function gridAction()
	{
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$adminGrid = Ccc::getBlock('Admin_Grid');
		$content->addChild($adminGrid);
		
		$this->randerLayout();
	}

	public function addAction()
	{
		$adminModel = Ccc::getModel('Admin');
		$admin = $adminModel;

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$adminEdit = Ccc::getBlock('Admin_Edit')->addData('admin',$admin);
		$content->addChild($adminEdit);

		$this->randerLayout();
	}

	public function editAction()
	{
		$adminModel = Ccc::getModel("Admin");
		$request = $this->getRequest();
		$adminId = $request->getRequest('id');
		if(!$adminId){
			$this->getMessage()->addMessage('Your data con not be fetch');
		}
		if(!(int)$adminId){
			$this->getMessage()->addMessage('Your data con not be fetch');
		}
		$admin = $adminModel->load($adminId);
		if(!$admin){
			$this->getMessage()->addMessage('Your data con not be fetch');
		}
		
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$adminEdit = Ccc::getBlock('Admin_Edit')->addData('admin',$admin);
		$content->addChild($adminEdit);

		$this->randerLayout();

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
					$this->getMessage()->addMessage('Your data con not be updated');
				}

				$adminData = $adminModel->setData($postData);

				if(!empty($adminId)){
					$adminData->admin_id = $adminId;
					$adminData->updatedDate = date("Y-m-d h:i:s");					;
					$admin = $adminModel->save();
					
					if(!$admin){
						$this->getMessage()->addMessage('Your data con not be updated');
					}
					$this->getMessage()->addMessage('Your Data Updated Successfully');
				}
				else{
					unset($adminData->admin_id);
					$adminData->createdDate = date("Y-m-d h:i:s");
					$adminId = $adminModel->save();
					
					if(!$adminId){
						$this->getMessage()->addMessage('Your data con not be saved');
					}
					$this->getMessage()->addMessage('Your Data Save Successfully');
				}
			}
			$this->redirect(Ccc::getBlock('Admin_Grid')->getUrl('grid','admin',[],true));
		}
		catch(Exception $e){
			$this->redirect(Ccc::getBlock('Admin_Grid')->getUrl('grid','admin',[],true));
		}

	}

	public function deleteAction()
	{
		$adminModel = Ccc::getModel('Admin');
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					$this->getMessage()->addMessage('Your Data can not be Deleted');
				}
				$adminId = $request->getRequest('id');
				$result = $adminModel->load($adminId)->delete();
				if(!$result){
					$this->getMessage()->addMessage('Your Data can not Deleted');
				}
				$this->getMessage()->addMessage('Your Data Delete Successfully');
				$this->redirect(Ccc::getBlock('Admin_Grid')->getUrl('grid','admin',[],true));

			} catch (Exception $e) {
				$this->redirect(Ccc::getBlock('Admin_Grid')->getUrl('grid','admin',[],true));
			}	
		}
	}


}

?>