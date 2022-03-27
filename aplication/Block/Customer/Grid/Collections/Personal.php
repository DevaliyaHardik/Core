<?php Ccc::loadClass('Block_Core_Grid_Collection');
Ccc::loadClass('Block_Customer_Grid_Collection');

class Block_Customer_Grid_Collections_Personal extends Block_Customer_Grid_Collection  
{ 
    public function __construct()
    {
        $this->setTemplate('view/customer/grid/collections/personal.php');
        $this->setCurrentCollection('personal');
        $this->prepareCollections();
    }

}
