<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Config_Grid extends Block_Core_Template
{
    protected $pager = null;

    public function __construct()
    {
        $this->setTemplate("view/config/grid.php");
    }

    public function getconfig()
    {
        $configModel = Ccc::getModel('Config');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('config_id') FROM `config`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $config = $configModel->fetchAll("SELECT * FROM `config` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        return $config;
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