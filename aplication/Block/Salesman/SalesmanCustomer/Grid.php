<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Salesman_SalesmanCustomer_Grid extends Block_Core_Template
{
    protected $pager = null;

    public function __construct()
    {
        $this->setTemplate("view/salesman/salesmancustomer/grid.php");
    }

    public function getCustomers()
    {
        $customerModel = Ccc::getModel('Customer');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $salesmanId = $request->getRequest('id');
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('customer_id') FROM `customer` WHERE `salesman_id` is null");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $customers = $customerModel->fetchAll("SELECT * FROM `customer` WHERE (`salesman_id` is null OR `salesman_id` = '$salesmanId') AND `status` = '1' LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        return $customers;
    }

    public function getSalesmanId()
    {
        return Ccc::getFront()->getRequest()->getRequest('id');
    }

    public function selected($customerId)
    {
        $request = Ccc::getFront()->getRequest();
        $salesmanId = $request->getRequest('id');
        $customerModel = Ccc::getModel('Customer');
        $select = $customerModel->fetchAll("SELECT * FROM `customer` WHERE `customer_id` = '$customerId' AND `salesman_id` = '$salesmanId'");
        if($select){
            return 'checked disabled';
        }
        return null;
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