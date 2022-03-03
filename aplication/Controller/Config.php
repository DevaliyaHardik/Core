<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php

class Controller_Config extends Controller_Core_Action{

	public function gridAction()
	{
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);


		$content = $this->getLayout()->getContent();
		$configGrid = Ccc::getBlock('Config_Grid');
		$content->addChild($configGrid);

		$this->randerLayout();
	}

	public function addAction()
	{
		$configModel = Ccc::getModel('config');
		$config = $configModel;

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);


		$content = $this->getLayout()->getContent();
		$configEdit = Ccc::getBlock('Config_Edit')->addData('config',$config);
		$content->addChild($configEdit);

		$this->randerLayout();
	}

	public function editAction()
	{
		$configModel = Ccc::getModel("config");
		$request = $this->getRequest();
		$configId = $request->getRequest('id');
		if(!$configId){
			$this->getMessage()->addMessage('Your data con not be fetch');
		}
		if(!(int)$configId){
			$this->getMessage()->addMessage('Your data con not be fetch');
		}
		$config = $configModel->load($configId);
		if(!$config){
			$this->getMessage()->addMessage('Your data con not be fetch');
		}

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);


		$content = $this->getLayout()->getContent();
		$configEdit = Ccc::getBlock('Config_Edit')->addData('config',$config);
		$content->addChild($configEdit);

		$this->randerLayout();
	}

	public function saveAction()
	{
		try{
			$configModel = Ccc::getModel('Config');
			$request = $this->getRequest();
			$configId = $request->getRequest('id');
			if($request->isPost()){
				$postData = $request->getPost('config');
				if(!$postData)
				{
					$this->getMessage()->addMessage('Your data con not be updated');
				}

				$configData = $configModel->setData($postData);

				if(!empty($configId)){
					$configData->config_id = $configId;
					$config = $configModel->save();
					
					if(!$config){
						$this->getMessage()->addMessage('Your data con not be updated');
					}
					$this->getMessage()->addMessage('Your Data Updated Successfully');
				}
				else{
					unset($configData->config_id);
					$configData->createdDate = date("Y-m-d h:i:s");
					$configId = $configModel->save();
					
					if(!$configId){
						$this->getMessage()->addMessage('Your data con not be saved');
					}
					$this->getMessage()->addMessage('Your Data Save Successfully');
				}
			}
			$this->redirect(Ccc::getBlock('Config_Grid')->getUrl('grid','config',[],true));
		}
		catch(Exception $e){
			echo $e->getMessage();			
		}

	}

	public function deleteAction()
	{
		$configModel = Ccc::getModel('Config');
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					$this->getMessage()->addMessage('Your Data can not be Deleted');
				}
				$configId = $request->getRequest('id');
				$result = $configModel->load($configId)->delete();
				if(!$result){
					throw new Exception("System is unable to delete data.", 1);	
				}
				$this->getMessage()->addMessage('Your Data Delete Successfully');
				$this->redirect(Ccc::getBlock('Config_Grid')->getUrl('grid','config',[],true));

			} catch (Exception $e) {
				echo $e->getMessage();
			}	
		}
	}


}

?>