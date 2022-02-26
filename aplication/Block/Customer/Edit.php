<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Customer_Edit extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/customer/edit.php");
    }

    public function getCustomer()
    {
        $customer = $this->getData('customer');
		return $customer;
    }

    public function getAddress()
    {
        $address = $this->getData('address');
        if($address == null){
            return Ccc::getModel('Customer_Address');
        }
        return $address;
    }
}

?>