<?php
Ccc::loadClass('Block_Core_Template');
class Block_Cart_Edit extends Block_Core_Template   
{ 

	public function __construct()
	{
		$this->setTemplate('view/cart/edit.php');
	}
	

	public function getCustomers()
	{
		$customerModel = Ccc::getModel('Customer');
		$customer = $customerModel->fetchAll("SELECT * FROM `customer`");
		return $customer;
	}

	public function getCart()
	{
		$cart = $this->cart;
		return $cart;
	}

	public function getProducts()
	{
		$productModel = Ccc::getModel('Product');
		$products = $productModel->fetchAll("SELECT * FROM `product` WHERE `status` = 1");
		return $products;
	}

}
?>