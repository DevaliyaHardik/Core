<?php
Ccc::loadClass('Block_Core_Template');

class Block_Cart_Edit_PaymentShiping extends Block_Core_Template{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("view/cart/edit/paymentShiping.php");
    }

    public function getCart()
	{
		if(!Ccc::getModel('Admin_Cart')->getCart()){
			return Ccc::getModel('Cart');
		}
		$cartId = Ccc::getModel('Admin_Cart')->getCart()['cart_id'];
		$cartModel = Ccc::getModel('Cart')->load($cartId);
		return $cartModel;
	}
}

?>