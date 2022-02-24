<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Product_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/product/grid.php");
    }

    public function getProduct()
    {
        $productModel = Ccc::getModel('product');
        $product = $productModel->fetchAll("SELECT * FROM `product`");
        return $product;
    }
}

?>