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
        $salesmanId = $request->getRequest('id');
        $customers = $customerModel->fetchAll("SELECT * FROM `customer` WHERE (`salesman_id` is null OR `salesman_id` = '$salesmanId') AND `status` = '1'");
        return $customers;
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

    public function getSaveUrl()
    {
        return $this->getUrl('save','Salesman_SalesmanCustomer');
    }

}