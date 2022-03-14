<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Category_Media_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/category/media/grid.php");
    }

    public function getMedias()
    {
        $mediaModel = Ccc::getModel('Category_Media');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('media_id') FROM `category_media`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $category_id = $request->getRequest('id');
        $category = $mediaModel->fetchAll("SELECT * FROM `category_media` WHERE `category_id` = '$category_id' LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        return $category;
    }

    public function selected($mediaId,$column)
    {
        $request = Ccc::getFront()->getRequest();
        $category_id = $request->getRequest('id');
        $categoryModel = Ccc::getModel('Category');
        $select = $categoryModel->fetchAll("SELECT * FROM `category` WHERE `$column` = '$mediaId'");
        if($select){
            return 'checked';
        }
    }

    public function getCategoryId()
    {
        $request = Ccc::getModel('Core_Request');
        return $request->getRequest('id');
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