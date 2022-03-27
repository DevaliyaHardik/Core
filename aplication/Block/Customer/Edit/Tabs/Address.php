<?php Ccc::loadClass('Block_Core_Template');
Ccc::loadClass('Block_Customer_Edit_Tab');

class Block_Customer_Edit_Tabs_Address extends Block_Core_Template   
{ 
    public function __construct()
    {
        $this->setTemplate('view/customer/edit/tabs/address.php');
    }

    public function getBilingAddress()
    {
        return Ccc::getRegistry('bilingAddress');
    }

    public function getShipingAddress()
    {
        return Ccc::getRegistry('shipingAddress');
    }
}
