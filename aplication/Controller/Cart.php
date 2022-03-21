<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php
echo "<pre>";
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
				$this->saveAddressAction($cart);
			}
			$this->redirect('edit');

		} catch (Exception $e) {
			$this->redirect('edit');
		}
		
	}

	public function saveAddressAction($cart)
	{
		try {
			$request = $this->getRequest();
			$customerId = $request->getRequest('id');
			$customer = $cart->getCustomer();
			$customerBilingAddress = $customer->getBilingAddress();
			$customerShipingAddress = $customer->getShipingAddress();
			if($customerBilingAddress){
				$bilingAddress = $cart->getBilingAddress();
				$bilingAddress->cart_id = $cart->cart_id;
				$bilingAddress->firstName = $customer->firstName;
				$bilingAddress->lastName = $customer->lastName;
				$bilingAddress->setData($customerBilingAddress->getData());
				unset($bilingAddress->address_id);
				unset($bilingAddress->customer_id);
				$bilingAddress->save();
			}
			if($customerShipingAddress){
				$shipingAddress = $cart->getShipingAddress();
				$shipingAddress->cart_id = $cart->cart_id;
				$shipingAddress->firstName = $customer->firstName;
				$shipingAddress->lastName = $customer->lastName;
				$shipingAddress->setData($customerShipingAddress->getData());
				unset($shipingAddress->address_id);
				unset($shipingAddress->customer_id);
				$shipingAddress->save();
			}		} catch (Exveption $e) {
			echo $e->message();
		}
	}

	public function saveCartAddressAction()
	{
		$request = $this->getRequest();
		$customerId = $request->getRequest('id');
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customer_id` = {$customerId}");
		$bilingData = $request->getPost('bilingAddress');
		$shipingData = $request->getPost('shipingAddress');
		$bilingAddress = $cart->getBilingAddress();
		$shipingAddress = $cart->getShipingAddress();
		$bilingAddress->setData($bilingData);
		$shipingAddress->setData($shipingData);
		$bilingAddress->save();
		$shipingAddress->save();
		if($request->getPost('saveInBilingBook')){
			$customer = $cart->getCustomer();
			$customerBilingAddress = $customer->getBilingAddress();
			$customerBilingAddress->setData($bilingData);
			unset($customerBilingAddress->firstName);
			unset($customerBilingAddress->lastName);
			$customerBilingAddress->save();
		}
		if($request->getPost('saveInShipingBook')){
			$customer = $cart->getCustomer();
			$customerShipingAddress = $customer->getShipingAddress();
			$customerShipingAddress->setData($shipingData);
			unset($customerShipingAddress->firstName);
			unset($customerShipingAddress->lastName);
			$customerShipingAddress->save();
		}
		$this->redirect('edit');
	}

	public function savePaymentMethodAction()
	{
		$request = $this->getRequest();
		$customerId = $request->getRequest('id');
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customer_id` = {$customerId}");
		$paymentData = $request->getPost('paymentMethod');
		$cart->setData(['paymentMethod' => $paymentData]);
		$cart->save();
		$this->redirect('edit');
	}

	public function saveShipingMethodAction()
	{
		$request = $this->getRequest();
		$customerId = $request->getRequest('id');
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customer_id` = {$customerId}");
		$shipingCharge = $request->getPost('shipingMethod');
		if($shipingCharge == 100){
			$shipingMethod = 'same day delivery';
		}
		elseif($shipingCharge == 70){
			$shipingMethod = 'express delivery';
		}
		else{
			$shipingMethod = 'normal delivery';
		}
		$cart->setData(['shipingMethod' => $shipingMethod, 'shipingCharge' => $shipingCharge]);
		$cart->save();
		$this->redirect('edit');
	}

	public function addCartItemAction()
	{
		$request = $this->getRequest();
		$productModel = Ccc::getModel('Product');
		$customerId = $request->getRequest('id');
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customer_id` = {$customerId}");
		$cartData = $request->getPost('cartItem');
		$item = $cart->getItem();
		$item->cart_id = $cart->cart_id;
		foreach($cartData as $cartItem){
			if(array_key_exists('product_id',$cartItem)){
				$item->setData($cartItem);
				$item->save();
				unset($item->item_id);
			}
		}
		$this->redirect('edit');
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