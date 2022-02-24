<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Media_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/product/media/grid.php");
    }

    public function getMedias()
    {
        $request = Ccc::getFront()->getRequest();
        $product_id = $request->getRequest('id');
        $productModel = Ccc::getModel('Product_Media');
        $product = $productModel->fetchAll("SELECT * FROM `media` WHERE `product_id` = $product_id ");
        return $product;
    }
}

?>