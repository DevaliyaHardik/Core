<?php Ccc::loadClass("Block_Core_Edit"); ?>
<?php

class Block_Category_Edit extends Block_Core_Edit
{
    public function __construct()
    {
        parent::__construct();
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

?>