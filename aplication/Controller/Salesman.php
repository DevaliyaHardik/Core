<?php Ccc::loadClass('Controller_Admin_Action') ?>
<?php

class Controller_Salesman extends Controller_Admin_Action{
	
	public function __construct()
	{
		$this->setTitle('Salesman');
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}

	public function indexAction()
	{
		$content = $this->getLayout()->getContent();
		$salesmanGrid = Ccc::getBlock('Salesman_Index');
		$content->addChild($salesmanGrid);

		$this->randerLayout();
	}

	public function gridBlockAction()
	{
		$salesmanGrid = Ccc::getBlock('Salesman_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $salesmanGrid,
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
		$salesmanModel = Ccc::getModel("Salesman");
		$salesman = $salesmanModel;

		Ccc::register('salesman',$salesman);
		$salesmanEdit = Ccc::getBlock('Salesman_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $salesmanEdit,
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
			$salesmanModel = Ccc::getModel("Salesman");
			$request = $this->getRequest();
			$salesmanId = $request->getRequest('id');
			if(!$salesmanId){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			if(!(int)$salesmanId){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			$salesman = $salesmanModel->load($salesmanId);
			if(!$salesman){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
	
			Ccc::register('salesman',$salesman);
			$salesmanEdit = Ccc::getBlock('Salesman_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $salesmanEdit,
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
			$salesmanEdit = Ccc::getBlock('Salesman_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $salesmanEdit,
						],
					[
						'element' => '#adminMessage',
						'content' => $messageBlock
					]
				]
			];
			$this->randerJson($response);
		}	
	}

	public function saveAction()
	{		
		try {
			$request = $this->getRequest();
			$salesmanModel = Ccc::getModel('Salesman');
			$request = $this->getRequest();
			$salesmanId = $request->getRequest('id');
			if($request->isPost()){
				if(!$request->getPost()){
					throw new Exception('Your data con not be inserted', 1);	
				}
				$postData = $request->getPost('salesman');
				$salesmanData = $salesmanModel->setData($postData);
	
				if(!empty($salesmanId)){
					$salesmanData->salesman_id = $salesmanId;
					$salesmanData->updatedDate = date("Y-m-d h:i:s");					;
				}
				else{
					$salesmanData->createdDate = date("Y-m-d h:i:s");					;
				}
				$result = $salesmanModel->save();
				if(!$result){
					throw new Exception('Salesman Can not saved', 1);
				}
				$this->getMessage()->addMessage('Salesman Saved Successfully');
			}
			$this->gridBlockAction();
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->gridBlockAction();
		}	
	}

	public function deleteAction()
	{
		$salesmanModel = Ccc::getModel('Salesman');
		$customerModel = Ccc::getModel('Customer');
		$customerPriceModel = Ccc::getModel('Customer_Price');
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					throw new Exception('Your Data can not be Deleted', 1);
				}
				
				$salesmanId=$request->getRequest('id');
				$customers = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `salesman_id` = {$salesmanId}");
				if($customers){
					foreach($customers as $customer){
						$customerPrices = $customerPriceModel->fetchAll("SELECT `entity_id` FROM `customer_price` WHERE `customer_id` = {$customer->customer_id}");
						foreach ($customerPrices as $customerPrice) {
							$customerPriceModel->load($customerPrice->entity_id)->delete();
						}
					}
				}

				$result = $salesmanModel->load($salesmanId)->delete();
				if(!$result){
					throw new Exception('Your Data can not Saved', 1);
				}

				$this->getMessage()->addMessage('Your Data Saved Successfully');
				$this->gridBlockAction();

			}catch (Exception $e){
				$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
				$this->gridBlockAction();
			}	
		}
	}

}

?>