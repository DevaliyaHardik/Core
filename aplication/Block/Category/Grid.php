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
        $this->addAction([
            'title' => 'media','method' => 'getMediaUrl','class' => 'category_media' 
        ],'Media');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $categories = $this->getCategory();
        $this->setCollection($categories);
        return $this;
    }

    public function getAdmins()
    {
        $adminModel = Ccc::getModel('Category');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('admin_id') FROM `admin`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $admins = $adminModel->fetchAll("SELECT * FROM `admin` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $adminColumn = [];
        foreach ($admins as $admin) {
            array_push($adminColumn,$admin);
        }        

        return $adminColumn;
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
        foreach ($categories as $category) {
            array_push($categoryColumn,$category);
        }        

        return $categoryColumn;
    }

    // public function getBase($baseId)
    // {
    //     $categoryModel = Ccc::getModel('Category');
    //     $base = $categoryModel->getBase($baseId);
    //     return $base;
    // }

    // public function getThumb($thumbId)
    // {
    //     $categoryModel = Ccc::getModel('Category');
    //     $thumb = $categoryModel->getThumb($thumbId);
    //     return $thumb;
    // }

    // public function getSmall($smallId)
    // {
    //     $categoryModel = Ccc::getModel('Category');
    //     $small = $categoryModel->getSmall($smallId);
    //     return $small;
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