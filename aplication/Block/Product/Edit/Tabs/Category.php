<?php Ccc::loadClass('Block_Core_Edit_Tabs_Content');

class Block_Product_Edit_Tabs_Category extends Block_Core_Edit_Tabs_Content   
{ 
    public function __construct()
    {
        $this->setTemplate('view/product/edit/tabs/category.php');
    }

    public function getCategory()
    {
        return Ccc::getModel('Category')->fetchAll("SELECT * FROM `category` WHERE `status` = 1");
    }

    public function selected($categoryId)
    {
        $request = Ccc::getFront()->getRequest();
        $productId = $request->getRequest('id');
        if($productId){
            $categoryProductModel = Ccc::getModel('Product_CategoryProduct');
            $select = $categoryProductModel->fetchAll("SELECT * FROM `category_product` WHERE `product_id` = '$productId' AND `category_id` = '$categoryId'");
            if($select){
                return 'checked';
            }
        }
        return null;
    }

}
