<?php Ccc::loadClass('Block_Core_Template');
Ccc::loadClass('Block_Category_Edit_Tab');

class Block_Category_Edit_Tabs_Personal extends Block_Core_Template   
{ 
    public function __construct()
    {
        $this->setTemplate('view/category/edit/tabs/personal.php');
    }

    public function getCategory()
    {
        return Ccc::getRegistry('category');
    }

    public function getCategories()
    {
        $categoryModel = Ccc::getModel('category');
        $categories = $categoryModel->fetchAll("SELECT * FROM `category` ORDER BY `path`");
        return $categories;
    }

    public function getPath($categoryId,$path)
    {
        $finalPath = NULL;
        $path = explode("/",$path);
        foreach ($path as $path1) {
            $load = Ccc::getModel('Category');
            $category = $load->load($path1);
            if($path1 != $categoryId){
                $finalPath .= $category->name."=>";
            }else{
                $finalPath .= $category->name;
            }
        }
        return $finalPath;
    }
}