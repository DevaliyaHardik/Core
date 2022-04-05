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

	public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$pageGrid = Ccc::getBlock('Config_Index');
		$content->addChild($pageGrid);

		$this->randerLayout();
	}

	public function gridBlockAction()
	{
		$this->getMessage()->addMessage('Config');
		$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $configGrid,
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
		$configModel = Ccc::getModel('config');
		$config = $configModel;

		Ccc::register('config',$config);
		$this->getMessage()->addMessage('Config Add');
		$configEdit = Ccc::getBlock('Config_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $configEdit,
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
			$configModel = Ccc::getModel("config");
			$request = $this->getRequest();
			$configId = $request->getRequest('id');
			if(!$configId){
				throw new Exception("Config data con not be fetch", 1);			
			}
			if(!(int)$configId){
				throw new Exception("Config data con not be fetch", 1);			
			}
			$config = $configModel->load($configId);
			if(!$config){
				throw new Exception("Config data con not be fetch", 1);			
			}
	
            Ccc::register('config',$config);
			$this->getMessage()->addMessage('Config Edit');
			$configEdit = Ccc::getBlock('Config_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $configEdit,
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
			$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $configGrid,
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
			$configModel = Ccc::getModel('Config');
			$request = $this->getRequest();
			$configId = $request->getRequest('id');
			if($request->isPost()){
				$postData = $request->getPost('config');
				if(!$postData)
				{
					$this->getMessage()->addMessage('Config data con not be updated', Model_Core_Message::MESSAGE_ERROR);
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
			$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $configGrid,
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
			$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $configGrid,
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
		$configModel = Ccc::getModel('Config');
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					throw new Exception('Config Data can not be Deleted', 1);			
				}
				$configId = $request->getRequest('id');
				$result = $configModel->load($configId)->delete();
				if(!$result){
					throw new Exception("System is unable to delete data.", 1);	
				}
				$this->getMessage()->addMessage('Config Data Delete Successfully');
				$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
				$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
				$response = [
					'status' => 'success',
					'elements' => [
						[
							'element' => '#indexContent',
							'content' => $configGrid,
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
				$configGrid = Ccc::getBlock('Config_Grid')->toHtml();
				$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
				$response = [
					'status' => 'success',
					'elements' => [
						[
							'element' => '#indexContent',
							'content' => $configGrid,
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