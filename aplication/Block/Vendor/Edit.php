<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Vendor_Edit extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/vendor/edit.php");
    }

    public function getvendor()
    {
        $vendor = $this->getData('vendor');
		return $vendor;
    }

    public function getAddress()
    {
        $address = $this->getData('address');
        if($address == null){
            return Ccc::getModel('Vendor_Address');
        }
        return $address;
    }
}

?>