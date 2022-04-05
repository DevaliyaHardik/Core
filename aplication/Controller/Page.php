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
		$this->getMessage()->addMessage('Page');
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
					'element' => 'message',
					'content' => $messageBlock,
					'type' => 'success'
				]
			]
		];
		$this->randerJson($response);
	}

	public function addBlockAction()
	{
		$pageModel = Ccc::getModel('Page');

		Ccc::register('page',$pageModel);
		$this->getMessage()->addMessage('Page Add');
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
					'element' => 'message',
					'content' => $messageBlock,
					'type' => 'success'
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
				throw new Exception("Page data con not be fetch", 1);			
			}
			if(!(int)$pageId){
				throw new Exception("Page data con not be fetch", 1);			
			}
			$page = $pageModel->load($pageId);
			if(!$page){
				throw new Exception("Page data con not be fetch", 1);			
			}
	
			Ccc::register('page',$page);
			$this->getMessage()->addMessage('Page Edit');
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
						'element' => 'message',
						'content' => $messageBlock,
						'type' => 'success'
					]
				]
			];
			$this->randerJson($response);
			}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
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
						'element' => 'message',
						'content' => $messageBlock,
						'type' => 'error'
					]
				]
			];
			$this->randerJson($response);
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
					throw new Exception('Page data con not be updated', 1);			
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
						'element' => 'message',
						'content' => $messageBlock,
						'type' => 'success'
					]
				]
			];
			$this->randerJson($response);
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
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
						'element' => 'message',
						'content' => $messageBlock,
						'type' => 'error'
					]
				]
			];
			$this->randerJson($response);
		}	
	}

	public function deleteAction()
	{
		$pageModel = Ccc::getModel('Page');
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					throw new Exception('Page Data can not be Deleted', 1);			
				}
				$pageId = $request->getRequest('id');
				$result = $pageModel->load($pageId)->delete();
				if(!$result){
					throw new Exception('Page Data can not be Deleted', 1);			
				}
				$this->getMessage()->addMessage('Page Data Delete Successfully');
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
							'element' => 'message',
							'content' => $messageBlock,
							'type' => 'success'
						]
					]
				];
				$this->randerJson($response);		
			}catch (Exception $e){
				$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
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
							'element' => 'message',
							'content' => $messageBlock,
							'type' => 'error'
						]
					]
				];
				$this->randerJson($response);
			}	
		}
	}
}

?>