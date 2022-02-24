<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Category_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/category/grid.php");
    }

    public function getCategory()
    {
        $categoryModel = Ccc::getModel('category');
        $category = $categoryModel->fetchAll("SELECT * FROM `category` ORDER BY `path`");
        return $category;
    }

    public function getPath($categoryId,$path)
    {
        $finalPath = NULL;
        $path = explode("/",$path);
        foreach ($path as $path1) {
            $load = Ccc::getModel('Category');
            $category = $load->fetchRow("SELECT `name` FROM `category` WHERE `category_id` = '$path1' ");
            if($path1 != $categoryId){
                $finalPath .= $category['name']."=>";
            }else{
                $finalPath .= $category['name'];
            }
        }
        return $finalPath;
    }
}

?>