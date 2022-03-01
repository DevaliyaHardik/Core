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
        $productModel = Ccc::getModel('Product');
        $product = $productModel->fetchAll("SELECT * FROM `product`");
        return $product;
    }

    public function getMedia($mediaId)
    {
        $mediaModel = Ccc::getModel('Product_Media');
        $media = $mediaModel->fetchAll("SELECT * FROM `product_media` WHERE `media_id` = '$mediaId'");
        return $media[0]->getData();
    }
}

?>