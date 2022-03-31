<?php Ccc::loadClass('Controller_Admin_Action') ?>
<?php

class Controller_Customer_Price extends Controller_Admin_Action{

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
		$customerPriceGrid = Ccc::getBlock('Customer_Price_Grid');
		$content->addChild($customerPriceGrid);

		$this->randerLayout();
	}

	public function gridBlockAction()
	{
		$customerGrid = Ccc::getBlock('Customer_Price_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $customerGrid
				],
				[
					'element' => '#adminMessage',
					'content' => $messageBlock
				]
			]
		];
		$this->randerJson($response);
	}

	public function saveAction()
	{
		try {
				$customerPriceModel = Ccc::getModel('Customer_Price');
				$request = $this->getRequest();
				$customerId = $request->getRequest('id');
				if($request->isPost()){
					$customers = $customerPriceModel->fetchAll("SELECT * FROM `customer_price` WHERE `customer_id` = '$customerId'");
					if($customers){
						foreach($customers as $customer){
							$customerPriceModel->load($customer->customer_id,'customer_id')->delete();
						}
					}
					$customerData = $request->getPost('product');
					$customerPriceModel->customer_id = $customerId;
					foreach($customerData as $customer){
						if($customer['slaesmanPrice'] <= $customer['price']){
							$customerPriceModel->price = $customer['price'];
						}
						else{
							$customerPriceModel->price = $customer['slaesmanPrice'];
						}
						if($customer['price']){
							$customerPriceModel->product_id = $customer['product_id'];
							$customerPriceModel->save();
							unset($customerPriceModel->entity_id);
						}
					}
				}
				$this->getMessage()->addMessage('Price set successfully');
				$this->redirect('grid','customer_price',['id' => $customerId],true);
			} catch (Exception $e) {
				$this->redirect('grid','customer_price',['id' => $customerId],true);
			}
	}
}

?>