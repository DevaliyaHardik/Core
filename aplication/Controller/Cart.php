<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_cart extends Controller_Admin_Action{

	public function __construct()
	{
		$this->setTitle('cart');
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
		$cartGrid = Ccc::getBlock('Cart_Grid');
		$content->addChild($cartGrid);
		
		$this->randerLayout();
	}

	public function addAction()
	{
		$cartModel = Ccc::getModel('cart');
		$cart = $cartModel;

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$cartEdit = Ccc::getBlock('cart_Edit');
		$cart = $cartEdit->cart = $cart;
		$content->addChild($cartEdit);

		$this->randerLayout();
	}

	public function editAction()
	{
		$request = $this->getRequest();
		$customerId = $request->getRequest('id');
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$cartModel = Ccc::getModel('Cart');
		$content = $this->getLayout()->getContent();
		if(!$customerId){
			$customer = $cartModel->getCustomer();
			$item = $cartModel->getItem();
			$bilingAddress = $cartModel->getBilingAddress();
			$shipingAddress = $cartModel->getShipingAddress();
		}
		else{
			$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customer_id` = {$customerId}");
			$customer = $cart->getCustomer(true);
			$item = $cart->getItem(true);
			$bilingAddress = $cart->getBilingAddress(true);
			$shipingAddress = $cart->getShipingAddress(true);
		}
		$cartModel->customer = $customer;
		$cartModel->item = $item;
		$cartModel->bilingAddress = $bilingAddress;
		$cartModel->shipingAddress = $shipingAddress;
		$cartEdit = Ccc::getBlock('Cart_Edit')->setData(['cart' => $cartModel]);
		$content->addChild($cartEdit);

		$this->randerLayout();

	}

	public function addCartAction()
	{
		try {
			$request = $this->getRequest();
			$customerId = $request->getRequest('id');
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customer_id` = {$customerId}");
			if($cart){
				$this->redirect('edit');
			}
			else{
				$cartModel->customer_id = $customerId;
				$cart = $cartModel->save();
				if(!$cart){
					$this->getMessage()->addMessage('Cart not added');
				}
				$this->redirect('edit');
			}
		} catch (Exception $e) {
			$this->redirect('edit');
		}
		
	}

	// public function saveAction()
	// {
	// 	try{
	// 		$cartModel = Ccc::getModel('cart');
	// 		$request = $this->getRequest();
	// 		$cartId = $request->getRequest('id');
	// 		if($request->isPost()){
	// 			$postData = $request->getPost('cart');
	// 			if(!$postData)
	// 			{
	// 				$this->getMessage()->addMessage('Your data con not be updated', Model_Core_Message::MESSAGE_ERROR);
	// 				throw new Exception("Error Processing Request", 1);			
	// 			}

	// 			$cartData = $cartModel->setData($postData);
	// 			$cartData->password = md5($cartData->password);
	// 			if(!empty($cartId)){
	// 				$cartData->cart_id = $cartId;
	// 				$cartData->updatedDate = date("Y-m-d h:i:s");
	// 			}
	// 			else{
	// 				unset($cartData->cart_id);
	// 				$cartData->createdDate = date("Y-m-d h:i:s");
	// 			}

	// 			$cartId = $cartModel->save();
	// 			if(!$cartId){
	// 				$this->getMessage()->addMessage('cart con not be saved', Model_Core_Message::MESSAGE_ERROR);
	// 				throw new Exception("Error Processing Request", 1);			
	// 			}
	// 			$this->getMessage()->addMessage('cart Save Successfully');
	// 		}
	// 		$this->redirect('grid',null,['id' => null]);
	// 	}
	// 	catch(Exception $e){
	// 		$this->redirect('grid',null,['id' => null]);
	// 	}

	// }

	// public function deleteAction()
	// {
	// 	$cartModel = Ccc::getModel('cart');
	// 	$request = $this->getRequest();
	// 	if(!$request->isPost()){
	// 		try {
	// 			if(!$request->getRequest('id')){
	// 				$this->getMessage()->addMessage('Your Data can not be Deleted');
	// 				throw new Exception("Error Processing Request", 1);			
	// 			}
	// 			$cartId = $request->getRequest('id');
	// 			$result = $cartModel->load($cartId)->delete();
	// 			if(!$result){
	// 				$this->getMessage()->addMessage('Your Data can not Deleted', Model_Core_Message::MESSAGE_ERROR);
	// 				throw new Exception("Error Processing Request", 1);			
	// 			}
	// 			$this->getMessage()->addMessage('Your Data Delete Successfully');
	// 			$this->redirect('grid',null,['id' => null]);

	// 		} catch (Exception $e) {
	// 			$this->redirect('grid',null,['id' => null]);
	// 		}	
	// 	}
	// }


}

?>