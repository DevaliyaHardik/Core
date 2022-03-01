<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php

class Controller_Page extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Page_Grid')->toHtml();
	}

	public function addAction()
	{
		$pageModel = Ccc::getModel('page');
		$page = $pageModel;
		Ccc::getBlock("Page_Edit")->addData('page',$page)->toHtml();
	}

	public function editAction()
	{
		$pageModel = Ccc::getModel("Page");
		$request = $this->getRequest();
		$pageId = $request->getRequest('id');
		if(!$pageId){
			throw new Exception("Id is not valid", 1);
		}
		if(!(int)$pageId){
			throw new Exception("Invalid request", 1);
		}
		$page = $pageModel->load($pageId);
		if(!$page){
			throw new Exception("System is unable to fine recored", 1);
		}
		Ccc::getBlock("Page_Edit")->addData('page',$page)->toHtml();
	}

	public function saveAction()
	{
		try{
			$pageModel = Ccc::getModel('Page');
			$request = $this->getRequest();
			$pageId = $request->getRequest('id');
			if($request->isPost()){
				$postData = $request->getPost('page');
				if(!$postData)
				{
					throw new Exception("Invalid data posted.", 1);	
				}

				$pageData = $pageModel->setData($postData);

				if(!empty($pageId)){
					$pageData->page_id = $pageId;
					$page = $pageModel->save();
					
					if(!$page){
						throw new Exception("System is unable to edit your data.", 1);	
					}
				}
				else{
					unset($pageData->page_id);
					$pageData->createdDate = date("Y-m-d h:i:s");
					$pageId = $pageModel->save();
					
					if(!$pageId){
						throw new Exception("System is unable to insert your data.", 1);	
					}
					
				}
			}
			$this->redirect(Ccc::getBlock('Page_Grid')->getUrl('grid','page',[],true));
		}
		catch(Exception $e){
			echo $e->getMessage();			
		}

	}

	public function deleteAction()
	{
		$pageModel = Ccc::getModel('Page');
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					throw new Exception("System is unable to delete your data",1);
				}
				$pageId = $request->getRequest('id');
				$result = $pageModel->load($pageId)->delete();
				if(!$result){
					throw new Exception("System is unable to delete data.", 1);	
				}
				$this->redirect(Ccc::getBlock('Page_Grid')->getUrl('grid','page',[],true));

			} catch (Exception $e) {
				echo $e->getMessage();
			}	
		}
	}


}

?>