<?php Ccc::loadClass('Block_Core_Grid'); 

class Block_Customer_Grid extends Block_Core_Grid {

    protected $pager = null;

	public function __construct()
	{
		parent::__construct();
		$this->prepareCollections();
	}

    public function prepareCollections()
    {

       	$this->addColumn([
		'title' => 'Customer Id',
		'type' => 'int',
		'key' =>'customer_id'
		],'id');
		$this->addColumn([
		'title' => 'First Name',
		'type' => 'varchar',
		'key' =>'firstName'
		],'First Name');
		$this->addColumn([
		'title' => 'Last Name',
		'type' => 'varchar',
		'key' =>'lastName'
		],'Last Name');
		$this->addColumn([
		'title' => 'Email',
		'type' => 'varchar',
		'key' =>'email'
		],'Email');
		$this->addColumn([
		'title' => 'Mobile',
		'type' => 'int',
		'key' =>'mobile'
		],'Mobile');
		$this->addColumn([
		'title' => 'Status',
		'type' => 'int',
		'key' =>'status'
		],'Status');
		$this->addColumn([
		'title' => 'Billing Address',
		'type' => 'varchar',
		'key' =>'biling'
		],'Billing Address');
		$this->addColumn([
		'title' => 'Shipping Address',
		'type' => 'varchar',
		'key' =>'shiping'
		],'Shipping Address');
		$this->addColumn([
		'title' => 'Created Date',
		'type' => 'datetime',
		'key' =>'createdDate'
		],'Created Date');
		$this->addColumn([
		'title' => 'Updated Date',
		'type' => 'datetime',
		'key' =>'updatedDate'
		],'Updated Date');
		$this->addAction([
            'title' => 'delete','method' => 'getDeleteUrl','class' => 'customer' 
        ],'Delete');
		$this->addAction([
            'title' => 'edit','method' => 'getEditUrl','class' => 'customer' 
        ],'Edit');
		$this->addAction([
            'title' => 'price','method' => 'getPriceUrl','class' => 'customer_price' 
        ],'Price');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $customers = $this->getCustomers();
        $this->setCollection($customers);
        return $this;
    }

    public function getCustomers()
    {
        $customerModel = Ccc::getModel('Customer');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = Ccc::getModel('Core_Adapter')->fetchOne("SELECT COUNT('customer_id') FROM `customer`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $customers = $customerModel->fetchAll("SELECT * FROM `customer` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $customerColumn = [];
        foreach ($customers as $customer) {
            $biling = null;
            $shiping = null; 
            foreach($customer->getBilingAddress()->getData() as $key => $value){
                if($key != 'address_id' && $key != 'customer_id' && $key != 'biling' && $key != 'shiping'){
                    $biling .= $key." : ".$value."<br>";
                }
            }
            foreach($customer->getShipingAddress()->getData() as $key => $value){
                if($key != 'address_id' && $key != 'customer_id' && $key != 'biling' && $key != 'shiping'){
                    $shiping .= $key." : ".$value."<br>";
                }
            }
            $customer->setData(['biling' => $biling]);
            $customer->setData(['shiping' => $shiping]);
            array_push($customerColumn,$customer);
        }        
        return $customerColumn;
    }

    public function getPager()
    {
        if(!$this->pager){
            $this->setPager(Ccc::getModel("Core_Pager"));
        }
        return $this->pager;
    }
    public function setPager($pager)
    {
        $this->pager=$pager;
        return $this;
    }	
}


?>