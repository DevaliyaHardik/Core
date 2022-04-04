<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content');

class Block_Product_Edit_Tabs_Personal extends Block_Core_Edit_Tabs_Content   
{ 
    public function __construct()
    {
        $this->setTemplate('view/product/edit/tabs/personal.php');
    }

    public function getProduct()
    {
        return Ccc::getRegistry('product');
    }
}
