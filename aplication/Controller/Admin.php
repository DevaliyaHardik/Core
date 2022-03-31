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
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->randerJson($response);
	}

	public function addBlockAction()
	{
		$adminModel = Ccc::getModel('Admin');
        Ccc::register('admin',$adminModel);

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
			$adminModel = Ccc::getModel("Admin");
			$request = $this->getRequest();
			$adminId = $request->getRequest('id');
			if(!$adminId){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception('Invalid Request', 1);			
			}
			if(!(int)$adminId){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception('Invalid Request', 1);
			}
			$admin = $adminModel->load($adminId);
			if(!$admin){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception('Invalid Request', 1);
			}
			
			$header = $this->getLayout()->getHeader();
			$menu = Ccc::getBlock('Core_Layout_Header_Menu');
			$message = Ccc::getBlock('Core_Layout_Header_Message');
			$header->addChild($menu)->addChild($message);
	
			$content = $this->getLayout()->getContent();
			$adminEdit = Ccc::getBlock('Admin_Edit');
            Ccc::register('admin',$admin);
			$content->addChild($adminEdit);
	
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
						'element' => '#adminMessage',
						'content' => $messageBlock
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


	// public function saveAction()
	// {
	// 	$adminGrid = Ccc::getBlock('Admin_Grid')->toHtml();
	// 	$response = [
	// 		'status' => 'success',
	// 		'content' => $adminGrid
	// 	];
	// 	$this->randerJson($response);
	// }

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
					throw new Exception('Your data con not be updated', 1);			
				}

				$adminData = $adminModel->setData($postData);
				$adminData->password = md5($adminData->password);
				if(!empty($adminId)){
					$adminData->admin_id = $adminId;
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
			$this->gridBlockAction();
			//$this->redirect('grid',null,['id' => null]);
		}
		catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->gridBlockAction();
            // $this->redirect('grid','customer',['id' => null]);
        }

	}


	public function deleteAction()
	{
		$adminModel = Ccc::getModel('Admin');
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					throw new Exception('Your Data can not be Deleted', 1);			
				}
				$adminId = $request->getRequest('id');
				$result = $adminModel->load($adminId)->delete();
				if(!$result){
					throw new Exception('Your Data can not Deleted', 1);			
				}
				$this->getMessage()->addMessage('Your Data Delete Successfully');
				//$this->redirect('grid',null,['id' => null]);
				$this->gridBlockAction();

			}catch (Exception $e)
	        {
	            $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
	            //$this->redirect('grid','customer',['id' => null]);
				$this->gridBlockAction();
	        }	
		}
	}


	// public function gridAction()
	// {
	// 	$content = $this->getLayout()->getContent();
	// 	$adminGrid = Ccc::getBlock('Admin_Grid');
	// 	$content->addChild($adminGrid);
		
	// 	$this->randerLayout();
	// }

	// public function addAction()
	// {
	// 	$adminModel = Ccc::getModel('Admin');
	// 	$admin = $adminModel;

	// 	$content = $this->getLayout()->getContent();
	// 	$adminEdit = Ccc::getBlock('Admin_Edit');
    //     Ccc::register('admin',$adminModel);
	// 	$content->addChild($adminEdit);

	// 	$this->randerLayout();
	// }

	// public function editAction()
	// {
	// 	try {
	// 		$adminModel = Ccc::getModel("Admin");
	// 		$request = $this->getRequest();
	// 		$adminId = $request->getRequest('id');
	// 		if(!$adminId){
	// 			$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
	// 			throw new Exception('Invalid Request', 1);			
	// 		}
	// 		if(!(int)$adminId){
	// 			$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
	// 			throw new Exception('Invalid Request', 1);
	// 		}
	// 		$admin = $adminModel->load($adminId);
	// 		if(!$admin){
	// 			$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
	// 			throw new Exception('Invalid Request', 1);
	// 		}
				
	// 		$content = $this->getLayout()->getContent();
	// 		$adminEdit = Ccc::getBlock('Admin_Edit');
    //         Ccc::register('admin',$admin);
	// 		$content->addChild($adminEdit);
	
	// 		$this->randerLayout();
	
	// 	}catch (Exception $e)
	// 	{
	// 		$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
	// 		$this->redirect('grid','customer');
	// 	}
	// }

	// public function saveAction()
	// {
	// 	try{
	// 		$adminModel = Ccc::getModel('Admin');
	// 		$request = $this->getRequest();
	// 		$adminId = $request->getRequest('id');
	// 		if($request->isPost()){
	// 			$postData = $request->getPost('admin');
	// 			if(!$postData)
	// 			{
	// 				throw new Exception('Your data con not be updated', 1);			
	// 			}

	// 			$adminData = $adminModel->setData($postData);
	// 			$adminData->password = md5($adminData->password);
	// 			if(!empty($adminId)){
	// 				$adminData->admin_id = $adminId;
	// 				$adminData->updatedDate = date("Y-m-d h:i:s");
	// 			}
	// 			else{
	// 				unset($adminData->admin_id);
	// 				$adminData->createdDate = date("Y-m-d h:i:s");
	// 			}

	// 			$adminId = $adminModel->save();
	// 			if(!$adminId){
	// 				throw new Exception('Admin con not be saved', 1);			
	// 			}
	// 			$this->getMessage()->addMessage('Admin Save Successfully');
	// 		}
	// 		$this->redirect('grid',null,['id' => null]);
	// 	}
	// 	catch (Exception $e)
    //     {
    //         $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
    //         $this->redirect('grid','customer',['id' => null]);
    //     }

	// }

}

?>