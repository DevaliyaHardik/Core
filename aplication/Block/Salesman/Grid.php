<?php Ccc::loadClass('Block_Core_Grid'); ?>
<?php

class Block_Salesman_Grid extends Block_Core_Grid
{
    protected $pager = null;
    
	public function __construct()
	{
		parent::__construct();
		$this->prepareCollections();
	}

    public function prepareCollections()
    {

       	$this->addColumn([
		'title' => 'Salesman Id',
		'type' => 'int',
		'key' =>'salesman_id'
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
        'title' => 'Percentage',
        'type' => 'int',
        'key' =>'percentage'
        ],'Percentage');
		$this->addColumn([
		'title' => 'Status',
		'type' => 'int',
		'key' =>'status'
		],'Status');
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
            'title' => 'delete','method' => 'getDeleteUrl','class' => 'Salesman' 
        ],'Delete');
		$this->addAction([
            'title' => 'edit','method' => 'getEditUrl','class' => 'Salesman' 
        ],'Edit');
		$this->addAction([
            'title' => 'customer','method' => 'getPriceUrl','class' => 'salesman_salesmanCustomer' 
        ],'Customer');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $Salesmans = $this->getSalesmans();
        $this->setCollection($Salesmans);
        return $this;
    }

    public function getsalesmans()
    {
        $salesmanModel = Ccc::getModel('Salesman');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('salesman_id') FROM `salesman`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $salesmans = $salesmanModel->fetchAll("SELECT * FROM `salesman` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $salesmanCloumn = [];
        foreach ($salesmans as $salesman) {
            array_push($salesmanCloumn,$salesman);
        }
        return $salesmanCloumn;
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