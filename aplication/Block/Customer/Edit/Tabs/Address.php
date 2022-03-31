<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content');
Ccc::loadClass('Block_Customer_Edit_Tab');

class Block_Customer_Edit_Tabs_Address extends Block_Core_Edit_Tabs_Content   
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
