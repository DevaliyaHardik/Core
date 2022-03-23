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
	public function gridAction()
	{
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$orderGrid = Ccc::getBlock('Order_Grid');
		$content->addChild($orderGrid);
		
		$this->randerLayout();
	}

	// public function addAction()
	// {
	// 	$OrderModel = Ccc::getModel('Order');
	// 	$Order = $OrderModel;

	// 	$header = $this->getLayout()->getHeader();
	// 	$menu = Ccc::getBlock('Core_Layout_Header_Menu');
	// 	$message = Ccc::getBlock('Core_Layout_Header_Message');
	// 	$header->addChild($menu)->addChild($message);

	// 	$content = $this->getLayout()->getContent();
	// 	$OrderEdit = Ccc::getBlock('Order_Edit');
	// 	$Order = $OrderEdit->Order = $Order;
	// 	$content->addChild($OrderEdit);

	// 	$this->randerLayout();
	// }

	public function editAction()
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
			
			$header = $this->getLayout()->getHeader();
			$menu = Ccc::getBlock('Core_Layout_Header_Menu');
			$message = Ccc::getBlock('Core_Layout_Header_Message');
			$header->addChild($menu)->addChild($message);
	
			$content = $this->getLayout()->getContent();
			$orderEdit = Ccc::getBlock('Order_Edit');
			$order->bilingAddress = $order->getBilingAddress();
			$order->shipingAddress = $order->getShipingAddress();
			$order->items = $order->getItems();

			$orderEdit = Ccc::getBlock('Order_Edit')->setData(['order' => $order]);
			$content->addChild($orderEdit);
	
			$this->randerLayout();
	
		}catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('grid','order');
		}
	}
}

?>