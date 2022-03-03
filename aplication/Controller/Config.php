<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php

class Controller_Config extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Config_Grid')->toHtml();
	}

	public function addAction()
	{
		$configModel = Ccc::getModel('config');
		$config = $configModel;
		Ccc::getBlock('Config_Edit')->addData('config',$config)->toHtml();
	}

	public function editAction()
	{
		$configModel = Ccc::getModel("config");
		$request = $this->getRequest();
		$configId = $request->getRequest('id');
		if(!$configId){
			throw new Exception("Id is not valid", 1);
		}
		if(!(int)$configId){
			throw new Exception("Invalid request", 1);
		}
		$config = $configModel->load($configId);
		if(!$config){
			throw new Exception("System is unable to fine recored", 1);
		}

		Ccc::getBlock('Config_Edit')->addData('config',$config)->toHtml();
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
					throw new Exception("Invalid data posted.", 1);	
				}

				$configData = $configModel->setData($postData);

				if(!empty($configId)){
					$configData->config_id = $configId;
					$config = $configModel->save();
					
					if(!$config){
						throw new Exception("System is unable to edit your data.", 1);	
					}
				}
				else{
					unset($configData->config_id);
					$configData->createdDate = date("Y-m-d h:i:s");
					$configId = $configModel->save();
					
					if(!$configId){
						throw new Exception("System is unable to insert your data.", 1);	
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
					throw new Exception("System is unable to delete your data",1);
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