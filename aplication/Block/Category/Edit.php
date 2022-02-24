<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Category_Edit extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/category/edit.php");
    }

    public function getcategory()
    {
        $category = $this->getData('category');
		return $category;
    }

    public function getCategories()
    {
        $fetch = Ccc::getModel('Category');
        $categories = $fetch->fetchAll("SELECT * FROM `category` ORDER BY `path`");
        return $categories;
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