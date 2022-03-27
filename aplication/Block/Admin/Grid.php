<?php Ccc::loadClass("Block_Core_Grid"); ?>
<?php

class Block_Admin_Grid extends Block_Core_Grid
{
    protected $pager = null;
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getEditUrl()
    {
        return $this->getUrl('grid','admin');
    }

    // public function getAdmin()
    // {
    //     $adminModel = Ccc::getModel('Admin');
    //     $request = Ccc::getModel('Core_Request');
    //     $this->setPager(Ccc::getModel('Core_Pager'));
    //     $current = $request->getRequest('p',1);
    //     $perPageCount = $request->getRequest('ppc',20);
    //     $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('admin_id') FROM `admin`");
    //     $this->getPager()->execute($totalCount,$current,$perPageCount);
    //     $admin = $adminModel->fetchAll("SELECT * FROM `admin` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
    //     return $admin;
    // }

    // public function setPager($pager)
    // {
    //     $this->pager = $pager;
    //     return $this;
    // }

    // public function getPager()
    // {
    //     if(!$this->pager){
    //         $this->setPager(Ccc::getModel('Core_Pager'));
    //     }
    //     return $this->pager;
    // }
}

?>