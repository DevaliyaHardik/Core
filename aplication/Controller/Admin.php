<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_Admin extends Controller_Admin_Action{

	public function __construct()
	{
		$this->setTitle('Admin');
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}

	public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$adminGrid = Ccc::getBlock('Admin_Index');
		$content->addChild($adminGrid);

		$this->randerLayout();
	}

	public function gridBlockAction()
	{
		$this->getMessage()->addMessage('Admin');
		$adminGrid = Ccc::getBlock('Admin_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $adminGrid,
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
		$adminModel = Ccc::getModel('Admin');
        Ccc::register('admin',$adminModel);

		$this->getMessage()->addMessage('Admin Add');
		$adminEdit = $this->getLayout()->getBlock('Admin_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $adminEdit,
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
			$adminModel = Ccc::getModel("Admin");
			$request = $this->getRequest();
			$adminId = $request->getRequest('id');
			if(!$adminId){
				$this->getMessage()->addMessage('Admin data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception('Invalid Request', 1);			
			}
			if(!(int)$adminId){
				$this->getMessage()->addMessage('Admin data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception('Invalid Request', 1);
			}
			$admin = $adminModel->load($adminId);
			if(!$admin){
				$this->getMessage()->addMessage('Admin data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception('Invalid Request', 1);
			}
			
            Ccc::register('admin',$admin);

			$this->getMessage()->addMessage('Admin Edit');
			$adminEdit = $this->getLayout()->getBlock('Admin_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $adminEdit,
					],
					[
						'element' => 'message',
						'content' => $messageBlock,
						'type' => 'success'
					]
				]
			];
			$this->randerJson($response);
		
		}catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('grid','customer');
		}
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
					throw new Exception('Admin data con not be updated', 1);			
				}

				$adminData = $adminModel->setData($postData);
				$adminData->password = md5($adminData->password);
				if(!empty($adminId)){
					$adminData->admin_id = $adminId;
					unset($adminData->password);
					$adminData->updatedDate = date("Y-m-d h:i:s");
				}
				else{
					unset($adminData->admin_id);
					$adminData->createdDate = date("Y-m-d h:i:s");
				}

				$adminId = $adminModel->save();
				if(!$adminId){
					throw new Exception('Admin con not be saved', 1);			
				}
				$this->getMessage()->addMessage('Admin Save Successfully');
			}
			$adminGrid = Ccc::getBlock('Admin_Grid')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $adminGrid,
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
		catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$adminGrid = Ccc::getBlock('Admin_Grid')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $adminGrid,
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
		$adminModel = Ccc::getModel('Admin');
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					throw new Exception('Admin Data can not be Deleted', 1);			
				}
				$adminId = $request->getRequest('id');
				$result = $adminModel->load($adminId)->delete();
				if(!$result){
					throw new Exception('Admin Data can not Deleted', 1);			
				}
				$this->getMessage()->addMessage('Admin Data Delete Successfully');
				$adminGrid = Ccc::getBlock('Admin_Grid')->toHtml();
				$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
				$response = [
					'status' => 'success',
					'elements' => [
						[
							'element' => '#indexContent',
							'content' => $adminGrid,
							],
						[
							'element' => 'message',
							'content' => $messageBlock,
							'type' => 'success'
						]
					]
				];
				$this->randerJson($response);		
			}catch (Exception $e)
	        {
	            $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
				$adminGrid = Ccc::getBlock('Admin_Grid')->toHtml();
				$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
				$response = [
					'status' => 'success',
					'elements' => [
						[
							'element' => '#indexContent',
							'content' => $adminGrid,
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