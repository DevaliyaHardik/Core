<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_Page extends Controller_Admin_Action{

	public function __construct()
	{
		$this->setTitle('Page');
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}

	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$pageGrid = Ccc::getBlock('Page_Grid');
		$content->addChild($pageGrid);

		$this->randerLayout();
	}

	public function addAction()
	{
		$pageModel = Ccc::getModel('Page');
		$page = $pageModel;

		$content = $this->getLayout()->getContent();
		$pageEdit = Ccc::getBlock('Page_Edit');
		$page = $pageEdit->page = $page;
		$content->addChild($pageEdit);

		$this->randerLayout();
	}

	public function editAction()
	{
		try {
			$pageModel = Ccc::getModel("Page");
			$request = $this->getRequest();
			$pageId = $request->getRequest('id');
			if(!$pageId){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			if(!(int)$pageId){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			$page = $pageModel->load($pageId);
			if(!$page){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
	
			$content = $this->getLayout()->getContent();
			$pageEdit = Ccc::getBlock('Page_Edit');
			$page = $pageEdit->page = $page;
			$content->addChild($pageEdit);
	
			$this->randerLayout();		
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('grid','customer');
		}	
		
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
					throw new Exception('Your data con not be updated', 1);			
				}

				$pageData = $pageModel->setData($postData);

				if(!empty($pageId)){
					$pageData->page_id = $pageId;
				}
				else{
					unset($pageData->page_id);
					$pageData->createdDate = date("Y-m-d h:i:s");
				}

				$pageId = $pageModel->save();	
				if(!$pageId){
					throw new Exception('Page con not be saved', 1);			
				}
				$this->getMessage()->addMessage('Page save successfully');
		}
			$this->redirect('grid',null,['id' => null]);
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('grid','customer',['id' => null]);
		}	
	}

	public function deleteAction()
	{
		$pageModel = Ccc::getModel('Page');
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					throw new Exception('Your Data can not be Deleted', 1);			
				}
				$pageId = $request->getRequest('id');
				$result = $pageModel->load($pageId)->delete();
				if(!$result){
					throw new Exception('Your Data can not be Deleted', 1);			
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