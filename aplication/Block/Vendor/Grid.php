<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Vendor_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/vendor/grid.php");
    }

    public function getvendor()
    {
        $vendorModel = Ccc::getModel('Vendor');
        $vendor = $vendorModel->fetchAll("SELECT * FROM `vendor`");
        return $vendor;
    }

    public function getAddress()
    {
        $addressModel = Ccc::getModel('Vendor');
        $address = $addressModel->fetchAll("SELECT * FROM `vendor_address`");
        return $address;
    }

}

?>