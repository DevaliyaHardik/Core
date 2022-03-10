<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_Page extends Controller_Admin_Action{

	public function __construct()
	{
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
		$pageGrid = Ccc::getBlock('Page_Grid');
		$content->addChild($pageGrid);

		$this->randerLayout();
	}

	public function addAction()
	{
		$pageModel = Ccc::getModel('page');
		$page = $pageModel;

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$pageEdit = Ccc::getBlock('Page_Edit')->addData('page',$page);
		$content->addChild($pageEdit);

		$this->randerLayout();
	}

	public function editAction()
	{
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

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$pageEdit = Ccc::getBlock('Page_Edit')->addData('page',$page);
		$content->addChild($pageEdit);

		$this->randerLayout();
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
					$this->getMessage()->addMessage('Your data con not be updated', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);			
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
					$this->getMessage()->addMessage('Page con not be saved', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);			
				}
				$this->getMessage()->addMessage('Page save successfully');
		}
			$this->redirect('grid','page',[],true);
		}
		catch(Exception $e){
			$this->redirect('grid','page',[],true);
		}

	}

	public function deleteAction()
	{
		$pageModel = Ccc::getModel('Page');
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					$this->getMessage()->addMessage('Your Data can not be Deleted', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);			
				}
				$pageId = $request->getRequest('id');
				$result = $pageModel->load($pageId)->delete();
				if(!$result){
					$this->getMessage()->addMessage('Your Data can not be Deleted', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);			
				}
				$this->getMessage()->addMessage('Your Data Delete Successfully');
				$this->redirect('grid','page',[],true);

			} catch (Exception $e) {
				$this->redirect('grid','page',[],true);
			}	
		}
	}


}

?>