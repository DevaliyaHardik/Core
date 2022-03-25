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
		$this->getCart()->unsetCart();
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$cartGrid = Ccc::getBlock('Cart_Grid');
		$content->addChild($cartGrid);
		
		$this->randerLayout();
	}

	public function editAction()
	{
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);
		$content = $this->getLayout()->getContent();
		$cartEdit = Ccc::getBlock('Cart_Edit');
		$content->addChild($cartEdit);
		
		$this->randerLayout();
	}

	public function addCartAction()
	{
		try {
			$request = $this->getRequest();
			$customerId = $request->getRequest('id');
			if($this->getCart()->getCart()){
				$this->redirect('edit');
			}
			else{
				$cartModel = Ccc::getModel('Cart');
				$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customer_id` = {$customerId}");
				if($cart){
					$this->getCart()->addCart($cart->cart_id);
					$this->redirect('edit');
				}
				else{
					$cartModel->customer_id = $customerId;
					$cartModel->status = 1;
					$cart = $cartModel->save();
					if(!$cart){
						$this->getMessage()->addMessage('Cart can not created');
					}
					$this->saveAddressAction($cart);
					$this->getCart()->addCart($cart->cart_id);
				}
				$this->redirect('edit',null,[],true);	
			}
		}catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('edit',null,[],true);
		}
		
	}

	public function saveAddressAction($cart)
	{
		try {
			$request = $this->getRequest();
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
				if(!$bilingAddress){
					throw new Exception("Biling address not saved.", 1);
				}
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
				if(!$shipingAddress){
					throw new Exception("Shiping address not saved.", 1);
				}
			}		
		}catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('edit');
		}
	}

	public function saveCartAddressAction()
	{
		try {
			$request = $this->getRequest();
			$cartId = $this->getCart()->getCart()['cart_id'];
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->load($cartId);
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
				if(!$customerBilingAddress){
					throw new Exception("Customer biling address not saved.", 1);
				}
			}
			if($request->getPost('saveInShipingBook')){
				$customer = $cart->getCustomer();
				$customerShipingAddress = $customer->getShipingAddress();
				$customerShipingAddress->setData($shipingData);
				unset($customerShipingAddress->firstName);
				unset($customerShipingAddress->lastName);
				$customerShipingAddress->save();
				if(!$customerShipingAddress){
					throw new Exception("Customer shiping address not saved.", 1);
				}
			}
			$this->redirect('edit');
			}catch (Exception $e)
			{
				$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
				$this->redirect('edit');
			}
	}

	public function savePaymentMethodAction()
	{
		try {
			$request = $this->getRequest();
			$cartId = $this->getCart()->getCart()['cart_id'];
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->load($cartId);
			$paymentData = $request->getPost('paymentMethod');
			$cart->setData(['paymentMethod' => $paymentData]);
			$result = $cart->save();
			if(!$result){
				throw new Exception("Payment method not saved.", 1);
			}
			$this->getMessage()->addMessage("Payment method saved.");
			$this->redirect('edit');
		}catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('edit');
		}
	}

	public function saveShipingMethodAction()
	{
		try {
			$request = $this->getRequest();
			$cartId = $this->getCart()->getCart()['cart_id'];
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->load($cartId);
			$shipingCharge = $request->getPost('shipingMethod');
			if($shipingCharge == 100){
				$shipingMethod = '1';
			}
			elseif($shipingCharge == 70){
				$shipingMethod = '2';
			}
			else{
				$shipingMethod = '3';
			}
			$cart->setData(['shipingMethod' => $shipingMethod, 'shipingCharge' => $shipingCharge]);
			$result = $cart->save();
			if(!$result){
				throw new Exception("Shiping method not saved.", 1);
			}
			$this->getMessage()->addMessage("Shiping method saved.");
			$this->redirect('edit');
		}catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('edit');
		}
	}

	public function addCartItemAction()
	{
		try {
			$request = $this->getRequest();
			$cartId = $this->getCart()->getCart()['cart_id'];
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->load($cartId);
			$productModel = Ccc::getModel('Product');
			$cartData = $request->getPost('cartItem');
			$item = $cart->getItem();
			$item->cart_id = $cart->cart_id;
			foreach($cartData as $cartItem){
				if(array_key_exists('product_id',$cartItem)){
					$product = $productModel->load($cartItem['product_id']);
					if($product->quntity >= $cartItem['quantity']){
						unset($item->item_id);
						$item->setData($cartItem);
						$item->itemTotal = $product->price * $cartItem['quantity'];
						$item->tax = $product->tax;
						$item->taxAmount = ($product->price * $product->tax / 100) * $cartItem['quantity'];
						$item->discount = $product->discount * $cartItem['quantity'];
						$item->save();
						$taxAmount += ($product->price * $product->tax / 100) * $cartItem['quantity'];
						$discount += $product->discount * $cartItem['quantity'];
						unset($item->item_id);
					}
				}
			}
			$subTotal = $item->fetchRow("SELECT sum(`itemTotal`) as subTotal FROM `cart_item`");
			$cart->subTotal = $subTotal->subTotal;
			$cart->taxAmount += $taxAmount;
			$cart->discount += $discount;
			$result = $cart->save();
			if(!$result){
				throw new Exception("subTotal not updated", 1);
			}
			$this->getMessage()->addMessage("Cart Item added successfully.");
			$this->redirect('edit');
		}catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('edit');
		}
	}

	public function deleteCartItemAction()
	{
		try {
			$request = $this->getRequest();
			$itemId = $request->getRequest('item_id');
			$item = Ccc::getModel('Cart_Item')->load($itemId);
			$cart = $item->getCart();
			$cart->subTotal = $cart->subTotal - $item->itemTotal;
			$cart->taxAmount = $cart->taxAmount - $item->taxAmount;
			$cart->discount = $cart->discount - $item->discount;
			$cart->save();
			$result = $item->delete();
			if(!$result){
				throw new Exception("Cart item not deleted.", 1);
			}
			$this->getMessage()->addMessage("Cart item deleted successfully.");
			$this->redirect('edit',null,['item_id' => null]);
		}catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('edit',null,['item_id' => null]);
		}
	}

	public function cartItemUpdateAction()
	{
		try {
			$request = $this->getRequest();
			$cartId = $this->getCart()->getCart()['cart_id'];
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->load($cartId);
			$productModel = Ccc::getModel('Product');
			$cartData = $request->getPost('cartItem');
			$item = $cart->getItem();
			foreach($cartData as $cartItem){
				$product = $productModel->load($cartItem['product_id']);
				if($product->quntity >= $cartItem['quantity']){
					$item->setData($cartItem);
					$item->itemTotal = $product->price * $cartItem['quantity'];
					$item->tax = $product->tax;
					$item->taxAmount = ($product->price * $product->tax / 100) * $cartItem['quantity'];
					$item->discount = $product->discount * $cartItem['quantity'];
					$taxAmount += ($product->price * $product->tax / 100) * $cartItem['quantity'];
					$discount += $product->discount * $cartItem['quantity'];
					$item->save();
				}
			}
			$subTotal = $item->fetchRow("SELECT sum(`itemTotal`) as subTotal FROM `cart_item`");
			$cart->subTotal = $subTotal->subTotal;
			$cart->taxAmount = $taxAmount;
			$cart->discount = $discount;
			$result = $cart->save();
			if(!$result){
				throw new Exception("subTotal not updated", 1);
			}
			$this->getMessage()->addMessage("Cart item updated successfully.");
			$this->redirect('edit');
		}catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('edit');
		}
	}

	public function placeOrderAction()
	{
		try {
			$request = $this->getRequest();
			$cartId = $this->getCart()->getCart()['cart_id'];
			$cartModel = Ccc::getModel('Cart');
			$cart = $cartModel->load($cartId);
			$customer = $cart->getCustomer();
			$orderModel = Ccc::getModel('order');
			$orderModel->customer_id = $customer->customer_id;
			$orderModel->firstName = $customer->firstName;
			$orderModel->lastName = $customer->lastName;
			$orderModel->email = $customer->email;
			$orderModel->mobile = $customer->mobile;
			$orderModel->shiping_id = $cart->shipingMethod;
			$orderModel->shipingCharge = $cart->shipingCharge;
			$orderModel->payment_id = $cart->paymentMethod;
			$orderModel->grandTotal = $request->getPost('grandTotal');
			$orderModel->taxAmount = $request->getPost('taxAmount');
			$orderModel->discount = $request->getPost('discount');	
			$order = $orderModel->save();
			if(!$order){
				throw new Exception("Order not added.", 1);
			}
	
			$items = $cart->getItems();
			foreach($items as $item){
				$product = $item->getProduct();
				$itemModel = Ccc::getModel('Order_Item');
				$itemModel->order_id = $order->order_id;
				$itemModel->product_id = $product->product_id;
				$itemModel->name = $product->name;
				$itemModel->sku = $product->sku;
				$itemModel->price = $item->itemTotal;
				$itemModel->tax = $product->tax;
				$itemModel->taxAmount = ($product->price * $product->tax / 100) * $item->quantity;
				$itemModel->discount = $product->discount;
				$itemModel->quantity = $item->quantity;
				$result = $itemModel->save();
				if($result){
					$item->delete();
				}
			}
			$addressModel = Ccc::getModel('Order_Address');
			$bilingData = $cart->getBilingAddress();
			$shipingData = $cart->getShipingAddress();
			$bilingAddress = $order->getBilingAddress();
			$shipingAddress = $order->getShipingAddress();
			unset($bilingData->cart_id);
			unset($bilingData->address_id);
			unset($shipingData->cart_id);
			unset($shipingData->address_id);
			$bilingAddress->setData($bilingData->getData());
			$bilingAddress->email = $customer->email;
			$bilingAddress->mobile = $customer->mobile;
			$bilingAddress->order_id = $order->order_id;
			$shipingAddress->setData($shipingData->getData());
			$shipingAddress->email = $customer->email;
			$shipingAddress->mobile = $customer->mobile;
			$shipingAddress->order_id = $order->order_id;
	
			$bilingResult = $bilingAddress->save();
			$shipinhResult = $shipingAddress->save();
			if(!$bilingResult){
				throw new Exception("Biling address not saved", 1);
			}
			if(!$shipinhResult){
				throw new Exception("Shiping address not saved", 1);
			}
			if($order){
				$cart->delete();
			}
			if($bilingResult){
				$bilingData->delete();
			}
			if($shipinhResult){
				$shipingData->delete();
			}
			
			$this->getMessage()->addMessage("Order placed successfully.");
			$this->redirect('grid',null,[],true);
			}catch (Exception $e)
		{
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('grid',null,[],true);
		}
	}
}

?>