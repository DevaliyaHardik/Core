<?php Ccc::loadClass('Block_Core_Template');
Ccc::loadClass('Block_Category_Edit_Tab');

class Block_Category_Edit_Tabs_Personal extends Block_Core_Template   
{ 
    public function __construct()
    {
        $this->setTemplate('view/category/edit/tabs/personal.php');
    }

    public function getCategory()
    {
        return Ccc::getRegistry('category');
    }
}
