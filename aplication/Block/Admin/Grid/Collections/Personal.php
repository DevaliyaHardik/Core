<?php Ccc::loadClass('Block_Core_Grid_Collection');
Ccc::loadClass('Block_Admin_Grid_Collection');

class Block_Admin_Grid_Collections_Personal extends Block_Admin_Grid_Collection  
{ 
    public function __construct()
    {
        $this->setTemplate('view/admin/grid/collections/personal.php');
        $this->setCurrentCollection('personal');
        $this->prepareCollections();
    }

    // public function getAdmin()
    // {
    //     return Ccc::getRegistry('admin');
    // }

    

}
