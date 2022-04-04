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

	public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$pageGrid = Ccc::getBlock('Page_Index');
		$content->addChild($pageGrid);

		$this->randerLayout();
	}

	public function gridBlockAction()
	{
		$pageGrid = Ccc::getBlock('Page_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $pageGrid,
				],
				[
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->randerJson($response);
	}

	public function addBlockAction()
	{
		$pageModel = Ccc::getModel('Page');

		Ccc::register('page',$pageModel);
		$pageEdit = Ccc::getBlock('Page_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $pageEdit,
				],
				[
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->randerJson($response);
	}

	public function editBlockAction()
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
	
			Ccc::register('page',$page);
			$pageEdit = Ccc::getBlock('Page_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $pageEdit,
					],
					[
						'element' => '#adminMessage',
						'content' => $messageBlock
					]
				]
			];
			$this->randerJson($response);
			}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('grid','page');
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
			$this->gridBlockAction();
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->gridBlockAction();
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
				$this->gridBlockAction();

			}catch (Exception $e){
				$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
				$this->gridBlockAction();
			}	
		}
	}
}

?>