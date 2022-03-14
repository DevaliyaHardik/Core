<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Product_Media_Grid extends Block_Core_Template
{
    protected $pager = null;

    public function __construct()
    {
        $this->setTemplate("view/product/media/grid.php");
    }

    public function getMedias()
    {
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('media_id') FROM `product_media`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $product_id = $request->getRequest('id');
        $mediaModel = Ccc::getModel('Product_Media');
        $product = $mediaModel->fetchAll("SELECT * FROM `product_media` WHERE `product_id` = $product_id LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        return $product;
    }

    public function selected($mediaId,$column)
    {
        $request = Ccc::getFront()->getRequest();
        $product_id = $request->getRequest('id');
        $productModel = Ccc::getModel('Product');
        $select = $productModel->fetchAll("SELECT * FROM `product` WHERE `$column` = '$mediaId'");
        if($select){
            return 'checked';
        }
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