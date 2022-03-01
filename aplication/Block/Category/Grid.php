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
            $categoryModel = Ccc::getModel('Category');
            $category = $categoryModel->fetchRow("SELECT * FROM `category` WHERE `category_id` = '$path1' ");
            if($path1 != $categoryId){
                $finalPath .= $category->name ."=>";
            }else{
                $finalPath .= $category->name;
            }
        }
        return $finalPath;
    }

    public function getMedia($mediaId)
    {
        $mediaModel = Ccc::getModel('Category_Media');
        $media = $mediaModel->fetchAll("SELECT * FROM `category_media` WHERE `media_id` = '$mediaId'");
        return $media[0]->getData();
    }

}

?>