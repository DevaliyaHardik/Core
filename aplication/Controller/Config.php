<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php

class Controller_Config extends Controller_Core_Action{

	public function gridAction()
	{
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$header->addChild($menu);


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
		$header->addChild($menu);


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
			throw new Exception("Invalid Request", 1);
		}
		if(!(int)$configId){
			throw new Exception("Invalid Request", 1);
		}
		$config = $configModel->load($configId);
		if(!$config){
			throw new Exception("Invalid Request", 1);
		}

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$header->addChild($menu);


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
					throw new Exception("Invalid Request", 1);
				}

				$configData = $configModel->setData($postData);

				if(!empty($configId)){
					$configData->config_id = $configId;
					$config = $configModel->save();
					
					if(!$config){
						throw new Exception("Invalid Request", 1);
					}
				}
				else{
					unset($configData->config_id);
					$configData->createdDate = date("Y-m-d h:i:s");
					$configId = $configModel->save();
					
					if(!$configId){
						throw new Exception("Invalid Request", 1);
					}
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
					throw new Exception("Invalid Request", 1);
				}
				$configId = $request->getRequest('id');
				$result = $configModel->load($configId)->delete();
				if(!$result){
					throw new Exception("System is unable to delete data.", 1);	
				}
				$this->redirect(Ccc::getBlock('Config_Grid')->getUrl('grid','config',[],true));

			} catch (Exception $e) {
				echo $e->getMessage();
			}	
		}
	}


}

?>