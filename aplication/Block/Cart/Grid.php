<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Cart_Grid extends Block_Core_Template
{
    protected $pager = null;
    
    public function __construct()
    {
        $this->setTemplate("view/cart/grid.php");
    }

    public function getOrders()
    {
        $orderModel = Ccc::getModel("Order");
        $request = Ccc::getModel('Core_Request');
        $orders = $orderModel->fetchAll("SELECT * FROM `order_final`");
        return $orders;
    }

}

?>