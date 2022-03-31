<?php Ccc::loadClass("Block_Core_Grid"); ?>
<?php

class Block_Product_Grid extends Block_Core_Grid
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
		'title' => 'Product Id',
		'type' => 'int',
		'key' =>'product_id'
		],'id');
        $this->addColumn([
        'title' => 'sku',
        'type' => 'varchar',
        'key' =>'sku'
        ],'sku');
		$this->addColumn([
		'title' => 'Name',
		'type' => 'varchar',
		'key' =>'name'
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
        'title' => 'Price',
        'type' => 'datetime',
        'key' =>'price'
        ],'Price');
        $this->addColumn([
        'title' => 'Cost',
        'type' => 'datetime',
        'key' =>'cost'
        ],'Cost');
        $this->addColumn([
        'title' => 'Status',
        'type' => 'datetime',
        'key' =>'status'
        ],'Status');
        $this->addColumn([
        'title' => 'Discount',
        'type' => 'datetime',
        'key' =>'discount'
        ],'Discount');
        $this->addColumn([
        'title' => 'Tax',
        'type' => 'datetime',
        'key' =>'tax'
        ],'Tax');
        $this->addColumn([
        'title' => 'Quntity',
        'type' => 'datetime',
        'key' =>'quntity'
        ],'Quntity');
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
            'title' => 'media','method' => 'getMediaUrl','class' => 'product_media' 
        ],'Media');
        $this->prepareCollectionContent();       
    }

    public function prepareCollectionContent()
    {
        $products = $this->getProducts();
        $this->setCollection($products);
        return $this;
    }

    public function getProducts()
    {
        $productModel = Ccc::getModel('Product');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('product_id') FROM `product`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $products = $productModel->fetchAll("SELECT * FROM `product` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $productColumn = [];
        foreach ($products as $product) {
            array_push($productColumn,$product);
        } 
        return $productColumn;       
    }

    // public function getMedia($mediaId)
    // {
    //     $mediaModel = Ccc::getModel('Product_Media');
    //     $media = $mediaModel->fetchAll("SELECT * FROM `product_media` WHERE `media_id` = '$mediaId'");
    //     return $media[0]->getData();
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

    public function getMediaUrl()
    {
        return Ccc::getModel('Core_View')->getUrl('grid','product_media');
    }
}

?>