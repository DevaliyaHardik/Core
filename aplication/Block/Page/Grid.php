<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Page_Grid extends Block_Core_Template
{
    protected $pager = null;

    public function __construct()
    {
        $this->setTemplate("view/page/grid.php");
    }

    public function getpage()
    {
        $pageModel = Ccc::getModel('Page');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $totalCount = $pageModel->fetchAll("SELECT COUNT(`page_id`) as `total` FROM `page`");
        $this->getPager()->execute($totalCount[0]->total,$current);
        $page = $pageModel->fetchAll("SELECT * FROM `page` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        return $page;
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