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
        $vendor = $this->vendor;
		return $vendor;
    }

    public function getAddress()
    {
        $address = $this->address;
        if($address == null){
            return Ccc::getModel('Vendor_Address');
        }
        return $address;
    }
}

?>