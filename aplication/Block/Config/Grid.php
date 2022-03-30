<?php Ccc::loadClass("Block_Core_Grid"); ?>
<?php

class Block_Config_Grid extends Block_Core_Grid
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
		'title' => 'Config Id',
		'type' => 'int',
		'key' =>'config_id'
		],'id');
		$this->addColumn([
		'title' => 'Name',
		'type' => 'varchar',
		'key' =>'name'
		],'Name');
		$this->addColumn([
		'title' => 'Last Name',
		'type' => 'varchar',
		'key' =>'lastName'
		],'Last Name');
		$this->addColumn([
		'title' => 'Code',
		'type' => 'varchar',
		'key' =>'code'
		],'Code');
		$this->addColumn([
		'title' => 'Value',
		'type' => 'varchar',
		'key' =>'value'
		],'Value');
		$this->addColumn([
		'title' => 'Created Date',
		'type' => 'datetime',
		'key' =>'createdDate'
		],'Created Date');
		$this->addAction([
            'title' => 'delete','method' => 'getDeleteUrl','class' => 'config' 
        ],'Delete');
		$this->addAction([
            'title' => 'edit','method' => 'getEditUrl','class' => 'config' 
        ],'Edit');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $configs = $this->getConfigs();
        $this->setCollection($configs);
        return $this;
    }

    public function getconfigs()
    {
        $configModel = Ccc::getModel('Config');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('config_id') FROM `config`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $configs = $configModel->fetchAll("SELECT * FROM `config` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $configColumn = [];
        foreach ($configs as $config) {
            array_push($configColumn,$config);
        }        
        return $configColumn;
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