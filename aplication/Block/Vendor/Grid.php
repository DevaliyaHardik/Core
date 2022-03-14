<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Vendor_Grid extends Block_Core_Template
{
    protected $pager = null;

    public function __construct()
    {
        $this->setTemplate("view/vendor/grid.php");
    }

    public function getvendor()
    {
        $vendorModel = Ccc::getModel('Vendor');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('vendor_id') FROM `vendor`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $vendor = $vendorModel->fetchAll("SELECT * FROM `vendor` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        return $vendor;
    }

    public function getAddress()
    {
        $addressModel = Ccc::getModel('Vendor');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('address_id') FROM `vendor_address`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $address = $addressModel->fetchAll("SELECT * FROM `vendor_address` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        return $address;
    }

    public function setPager($pager)
    {
        $this->pager = $pager;
        return $this;
    }

    public function getPager()
    {
        if(!$this->pager){
            $this->setPager(Ccc::getModel('Core_Pager'));
        }
        return $this->pager;
    }
}

?>