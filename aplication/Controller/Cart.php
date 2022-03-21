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
			$cart = $cartModel;
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
		$cartModel->cart = $cart;
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
			$shipingMethod = '1';
		}
		elseif($shipingCharge == 70){
			$shipingMethod = '2';
		}
		else{
			$shipingMethod = '3';
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
				$product = $productModel->load($cartItem['product_id']);
				if($product->quntity >= $cartItem['quantity']){
					unset($item->item_id);
					$item->setData($cartItem);
					$item->itemTotal = $product->price * $cartItem['quantity'];
					$item->save();
					unset($item->item_id);
				}
			}
		}
		$this->redirect('edit');
	}

	public function deleteCartItemAction()
	{
		$request = $this->getRequest();
		$itemId = $request->getRequest('item_id');
		$item = Ccc::getModel('Cart_Item');
		$result = $item->load($itemId)->delete();
		if($result){
			$this->redirect('edit',null,['item_id' => null]);
		}
		$this->redirect('edit',null,['item_id' => null]);
	}

	public function cartItemUpdateAction()
	{
		$request = $this->getRequest();
		$productModel = Ccc::getModel('Product');
		$customerId = $request->getRequest('id');
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customer_id` = {$customerId}");
		$cartData = $request->getPost('cartItem');
		$item = $cart->getItem();
		foreach($cartData as $cartItem){
			$product = $productModel->load($cartItem['product_id']);
			if($product->quntity >= $cartItem['quantity']){
				$item->setData($cartItem);
				$item->itemTotal = $product->price * $cartItem['quantity'];
				$item->save();
			}
		}
		$this->redirect('edit');
	}

	public function placeOrderAction()
	{
		echo "<pre>";
		$request = $this->getRequest();
		$productModel = Ccc::getModel('Product');
		$customerId = $request->getRequest('id');
		$cartModel = Ccc::getModel('Cart');
		$cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customer_id` = {$customerId}");
		$customer = $cart->getCustomer();
		$orderModel = Ccc::getModel('order');
		$orderModel->customer_id = $customerId;
		$orderModel->firstName = $customer->firstName;
		$orderModel->lastName = $customer->lastName;
		$orderModel->email = $customer->email;
		$orderModel->mobile = $customer->mobile;
		$orderModel->shiping_id = $cart->shipingMethod;
		$orderModel->shipingCharge = $cart->shipingCharge;
		$orderModel->payment_id = $cart->paymentMethod;
		$orderModel->grandTotal = $request->getPost('grandTotal');
		$order = $orderModel->save();

		$items = $cart->getItems();
		foreach($items as $item){
			$product = $item->getProduct();
			$itemModel = Ccc::getModel('Order_Item');
			$itemModel->order_id = $order->order_id;
			$itemModel->product_id = $product->product_id;
			$itemModel->name = $product->name;
			$itemModel->sku = $product->sku;
			$itemModel->price = $item->itemTotal;
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

		if($order){
			$cart->delete();
		}
		if($bilingResult){
			$bilingData->delete();
		}
		if($shipinhResult){
			$shipingData->delete();
		}
		
		$this->redirect('grid',null,[],true);
	}
}

?>