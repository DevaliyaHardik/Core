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
        $fetchQuery = "SELECT p.*,b.name as base,t.name as thumb,s.name as small FROM `product` as p 
        left join media as b ON p.`product_id` = b.`product_id` AND b.base = 1
        left join media as t ON p.`product_id` = t.`product_id` AND t.thumb = 1
        left join media as s ON p.`product_id` = s.`product_id` AND s.small = 1";
        $productModel = Ccc::getModel('product');
        $product = $productModel->fetchAll($fetchQuery);
        return $product;
    }
}

?>