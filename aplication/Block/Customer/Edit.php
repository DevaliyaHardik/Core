<?php Ccc::loadClass('Block_Core_Edit'); ?>
<?php

class Block_Customer_Edit extends Block_Core_Edit
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCustomer()
    {
        $customer = $this->customer;
		return $customer;
    }

    public function getAddress()
    {
        $address = $this->address;
        if($address == null){
            return Ccc::getModel('Customer_Address');
        }
        return $address;
    }

    public function getEditUrl()
    {
        return $this->getUrl('save','customer');
    }

    public function getSaveUrl()
    {
        return $this->getUrl('save','customer');
    }
}

?>