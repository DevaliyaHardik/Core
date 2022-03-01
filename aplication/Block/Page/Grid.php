<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Page_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/page/grid.php");
    }

    public function getpage()
    {
        $pageModel = Ccc::getModel('Page');
        $page = $pageModel->fetchAll("SELECT * FROM `page`");
        return $page;
    }
}

?>