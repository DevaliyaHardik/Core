<?php Ccc::loadClass('Block_Core_Grid'); ?>
<?php

class Block_Customer_Grid extends Block_Core_Grid
{
    protected $pager = null;
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getCollectionData()
    {
        return $this->getCollection();
    }

    // public function getCustomer()
    // {
    //     $customerModel = Ccc::getModel('customer');
    //     $request = Ccc::getModel('Core_Request');
    //     $this->setPager(Ccc::getModel('Core_Pager'));
    //     $current = $request->getRequest('p',1);
    //     $perPageCount = $request->getRequest('ppc',20);
    //     $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('customer_id') FROM `customer`");
    //     $this->getPager()->execute($totalCount,$current,$perPageCount);

    //     $customer = $customerModel->fetchAll("SELECT * FROM `customer` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
    //     return $customer;
    // }

    // public function getAddress()
    // {
    //     $addressModel = Ccc::getModel('customer');
    //     $request = Ccc::getModel('Core_Request');
    //     $this->setPager(Ccc::getModel('Core_Pager'));
    //     $current = $request->getRequest('p',1);
    //     $perPageCount = $request->getRequest('ppc',20);
    //     $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('address_id') FROM `customer_address`");
    //     $this->getPager()->execute($totalCount,$current,$perPageCount);
    //     $address = $addressModel->fetchAll("SELECT * FROM `customer_address` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
    //     return $address;
    // }

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