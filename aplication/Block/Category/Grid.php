<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Category_Grid extends Block_Core_Template
{
    protected $pager = null;

    public function __construct()
    {
        $this->setTemplate("view/category/grid.php");
    }

    public function getCategory()
    {
        $categoryModel = Ccc::getModel('category');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('category_id') FROM `category`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $category = $categoryModel->fetchAll("SELECT * FROM `category` ORDER BY `path` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
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

    public function setPager($pager)
    {
        $this->pager = $pager;
        return $this;
    }

    public function getPager()
    {
        if(!$this->pager){
            $this->setPager(Ccc::getModel('Core_Pager'));
        }
        return $this->pager;
    }
}

?>