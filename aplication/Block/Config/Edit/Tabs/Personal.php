<?php Ccc::loadClass('Block_Core_Template');
Ccc::loadClass('Block_Config_Edit_Tab');

class Block_Config_Edit_Tabs_Personal extends Block_Core_Template   
{ 
    public function __construct()
    {
        $this->setTemplate('view/config/edit/tabs/personal.php');
    }

    public function getConfig()
    {
        return Ccc::getRegistry('config');
    }
}
