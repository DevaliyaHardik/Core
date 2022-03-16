<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_Config extends Controller_Admin_Action{
	
	public function __construct()
	{
		$this->setTitle('Config');
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
		$configEdit = Ccc::getBlock('Config_Edit');
		$configEdit->config = $config;
		$content->addChild($configEdit);

		$this->randerLayout();
	}

	public function editAction()
	{
		try {
			$configModel = Ccc::getModel("config");
			$request = $this->getRequest();
			$configId = $request->getRequest('id');
			if(!$configId){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			if(!(int)$configId){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			$config = $configModel->load($configId);
			if(!$config){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
	
			$header = $this->getLayout()->getHeader();
			$menu = Ccc::getBlock('Core_Layout_Header_Menu');
			$message = Ccc::getBlock('Core_Layout_Header_Message');
			$header->addChild($menu)->addChild($message);
	
	
			$content = $this->getLayout()->getContent();
			$configEdit = Ccc::getBlock('Config_Edit');
			$configEdit->config = $config;
			$content->addChild($configEdit);
	
			$this->randerLayout();
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('grid','customer');
		}	
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
					$this->getMessage()->addMessage('Your data con not be updated', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);			
				}

				$configData = $configModel->setData($postData);

				if(!empty($configId)){
					$configData->config_id = $configId;
				}
				else{
					unset($configData->config_id);
					$configData->createdDate = date("Y-m-d h:i:s");
				}
				$configId = $configModel->save();
				if(!$configId){
					$this->getMessage()->addMessage('Config con not be saved', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);			
				}
				$this->getMessage()->addMessage('Config saved successfully');
			}
			$this->redirect('grid',null,['id' => null]);
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('grid','customer',['id' => null]);
		}	
	}

	public function deleteAction()
	{
		$configModel = Ccc::getModel('Config');
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					throw new Exception('Your Data can not be Deleted', 1);			
				}
				$configId = $request->getRequest('id');
				$result = $configModel->load($configId)->delete();
				if(!$result){
					throw new Exception("System is unable to delete data.", 1);	
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