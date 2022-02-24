<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Customer_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/customer/grid.php");
    }

    public function getCustomer()
    {
        $customerModel = Ccc::getModel('customer');
        $customer = $customerModel->fetchAll("SELECT * FROM `customer`");
        return $customer;
    }

    public function getAddress()
    {
        $addressModel = Ccc::getModel('customer');
        $address = $addressModel->fetchAll("SELECT * FROM `address`");
        return $address;
    }

}

?>