<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Product_Grid extends Block_Core_Template
{
    protected $pager = null;

    public function __construct()
    {
        $this->setTemplate("view/product/grid.php");
    }

    public function getProduct()
    {
        $productModel = Ccc::getModel('Product');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('product_id') FROM `product`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $product = $productModel->fetchAll("SELECT * FROM `product` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        return $product;
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
}

?>