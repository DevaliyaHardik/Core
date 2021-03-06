<?php Ccc::loadClass("Block_Core_Grid"); ?>
<?php

class Block_Category_Grid extends Block_Core_Grid
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
		'title' => 'Category Id',
		'type' => 'int',
		'key' =>'category_id'
		],'id');
		$this->addColumn([
		'title' => 'Name',
		'type' => 'varchar',
		'key' =>'path'
		],'Name');
		$this->addColumn([
		'title' => 'Base',
		'type' => 'varchar',
		'key' =>'base'
		],'Base');
		$this->addColumn([
		'title' => 'Thumb',
		'type' => 'varchar',
		'key' =>'thumb'
		],'Thumb');
		$this->addColumn([
		'title' => 'Small',
		'type' => 'int',
		'key' =>'small'
		],'Small');
		$this->addColumn([
		'title' => 'Status',
		'type' => 'datetime',
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
            'title' => 'delete','method' => 'getDeleteUrl','class' => 'category' 
        ],'Delete');
		$this->addAction([
            'title' => 'edit','method' => 'getEditUrl','class' => 'category' 
        ],'Edit');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $categories = $this->getCategory();
        $this->setCollection($categories);
        return $this;
    }

    public function getCategory()
    {
        $categoryModel = Ccc::getModel('category');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('category_id') FROM `category`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $categories = $categoryModel->fetchAll("SELECT * FROM `category` ORDER BY `path` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $categoryColumn = [];
        if(!$categories){
            return null;
        }
        foreach ($categories as $category) {
            array_push($categoryColumn,$category);
        }        

        return $categoryColumn;
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