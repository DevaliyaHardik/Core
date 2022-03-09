<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Customer_Price_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/customer/price/grid.php");
    }

    public function getProducts()
    {
        $request = Ccc::getFront()->getRequest();
        $customerId = $request->getRequest('id');
        $productModel = Ccc::getModel('product');
        $customerModel = Ccc::getModel('customer');
        $customer = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `customer_id` = {$customerId} AND `salesman_id` IS NOT NULL");
        if(!$customer){
            return $productModel->getData();
        }
        $products = $productModel->fetchAll("SELECT * FROM `product` WHERE `status` = '1' ");
        return $products;
    }

    public function getCustomerPrice($productId)
    {
        $request = Ccc::getFront()->getRequest();
        $customerId = $request->getRequest('id');
        $customerPriceModel = Ccc::getModel('Customer_Price');
        $discount = $customerPriceModel->fetchAll("SELECT * FROM `customer_price` WHERE `product_id` = '$productId' AND `customer_id` = '$customerId' ");
        if(!$discount){
            return null;
        }
        return $discount[0]->price;
    }

    public function getSalesmanPrice($productId)
    {
        $request = Ccc::getFront()->getRequest();
        $customerId = $request->getRequest('id');
        $productModel = Ccc::getModel('product');
        $salesmanModel = Ccc::getModel('salesman');
        $customerModel = Ccc::getModel('customer');
        $customer = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `customer_id` = {$customerId}");
        if($customer){
            $salesman = $salesmanModel->fetchAll("SELECT * FROM `salesman` WHERE `salesman_id` = {$customer[0]->salesman_id}");
            if($salesman){
                $product = $productModel->fetchAll("SELECT * FROM `product` WHERE `product_id` = {$productId}");
                return $product[0]->price - $product[0]->price*$salesman[0]->discount/100;
            }
        }



    }
}

?>