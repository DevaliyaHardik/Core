<?php Ccc::loadClass("Block_Core_Grid"); ?>
<?php

class Block_Page_Grid extends Block_Core_Grid
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
		'title' => 'Page Id',
		'type' => 'int',
		'key' =>'page_id'
		],'id');
		$this->addColumn([
		'title' => 'Name',
		'type' => 'varchar',
		'key' =>'name'
		],'Name');
		$this->addColumn([
		'title' => 'Code',
		'type' => 'varchar',
		'key' =>'code'
		],'Code');
		$this->addColumn([
		'title' => 'Content',
		'type' => 'text',
		'key' =>'content'
		],'Content');
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
            'title' => 'delete','method' => 'getDeleteUrl','class' => 'page' 
        ],'Delete');
		$this->addAction([
            'title' => 'edit','method' => 'getEditUrl','class' => 'page' 
        ],'Edit');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $pages = $this->getpages();
        $this->setCollection($pages);
        return $this;
    }

    public function getPages()
    {
        $pageModel = Ccc::getModel('Page');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('page_id') FROM `page`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $pages = $pageModel->fetchAll("SELECT * FROM `page` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $pageColumn = [];
        foreach ($pages as $page) {
            array_push($pageColumn,$page);
        }
        return $pageColumn;
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