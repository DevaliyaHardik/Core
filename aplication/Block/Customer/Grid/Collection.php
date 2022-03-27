<?php Ccc::loadClass('Block_Core_Grid_Collection');

class Block_Customer_Grid_Collection extends Block_Core_Grid_Collection   
{
    public function __construct()
    {
        parent::__construct();
        $this->setCurrentCollection('personal');
    }

    public function prepareCollections()
    {
        $customerModel = Ccc::getModel('Customer');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('customer_id') FROM `customer`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $customers = $customerModel->fetchAll("SELECT * FROM `customer` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $customerColumn = [];
        foreach ($customers as $customer) {
            $biling = null;
            $shiping = null;    
            foreach($customer->getBilingAddress()->getData() as $key => $value){
                if($key != 'address_id' && $key != 'customer_id'){
                    $biling .= $key." : ".$value."<br>";
                }
            }
            foreach($customer->getShipingAddress()->getData() as $key => $value){
                if($key != 'address_id' && $key != 'customer_id'){
                    $shiping .= $key." : ".$value."<br>";
                }
            }
            $customer->setData(['biling' => $biling]);
            $customer->setData(['shiping' => $shiping]);
            array_push($customerColumn,$customer);
        }        

        $this->addCollection([
            'title' => 'Personal Info',
            'block' => 'Customer_Grid_Collections_Personal',
            'action' => ['Edit' => ['title' => 'edit','method' => 'getEditUrl()'],
                        'Delete' => ['title' => 'delete','method' => 'getDeleteUrl()']
            ],
            'header' => ['Customer Id','First Name','Last Name','Email','Mobile','Status','Salesman Id','Created Date','Updated Date','Biling Address','Shiping Address'],
            'columns' => $customerColumn,
            'url' => $this->getUrl(null,null,['collection' => 'personal'])
        ],'personal');
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
