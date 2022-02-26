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
        /*$fetchQuery = "SELECT p.*,b.name as base,t.name as thumb,s.name as small FROM `product` as p 
        left join product_media as b ON p.`product_id` = b.`product_id` AND b.base = 1
        left join product_media as t ON p.`product_id` = t.`product_id` AND t.thumb = 1
        left join product_media as s ON p.`product_id` = s.`product_id` AND s.small = 1";*/
        $productModel = Ccc::getModel('product');
        $product = $productModel->fetchAll("SELECT * FROM `product`");
        return $product;
    }

    public function getMedia($mediaId)
    {
        $mediaModel = Ccc::getModel('product');
        $media = $mediaModel->fetchAll("SELECT * FROM `product_media` WHERE `media_id` = '$mediaId'");
        return $media[0]->getData();
    }
}

?>