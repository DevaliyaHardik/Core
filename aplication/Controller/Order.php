<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_Order extends Controller_Admin_Action{

	public function __construct()
	{
		$this->setTitle('Order');
		if(!$this->authentication()){
			$this->redirect('login','Admin_login');
		}
	}
	public function gridBlockAction()
	{
		$orderGrid = Ccc::getBlock('Order_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $orderGrid,
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
			$orderModel = Ccc::getModel("Order");
			$request = $this->getRequest();
			$orderId = $request->getRequest('id');
			if(!$orderId){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception('Invalid Request', 1);			
			}
			if(!(int)$orderId){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception('Invalid Request', 1);
			}
			$order = $orderModel->load($orderId);
			if(!$order){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception('Invalid Request', 1);
			}
	
			Ccc::register('order',$order);
			$orderEdit = Ccc::getBlock('Order_Edit')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $orderEdit,
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
			$orderGrid = Ccc::getBlock('Order_Grid')->toHtml();
			$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $orderGrid,
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

	public function statusUpdateAction()
	{
		try {
			$request = $this->getRequest();
			$orderId = $request->getRequest('id');
			$order = Ccc::getModel('Order')->load($orderId);
			$comment = $order->getComment();
			$postData = $request->getPost('order');
			$order->status = $postData['status'];
			$order->state = $postData['state'];
			$result = $order->save();
			if(!$result){
				throw new Exception("Status Not Updated.", 1);
			}
			$comment->setData($postData);
			$comment->order_id = $orderId;
			unset($comment->state);
			$success = $comment->save();
			if(!$success){
				throw new Exception("Comment Not Saved", 1);
			}
			$this->getMessage()->addMessage('Order Status Saved');
			$this->editBlockAction();
		} catch (Exception $e) {
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->editBlockAction();
		}
	}
}

?>