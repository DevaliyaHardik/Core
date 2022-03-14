<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Salesman_Grid extends Block_Core_Template
{
    protected $pager = null;
    
    public function __construct()
    {
        $this->setTemplate("view/salesman/grid.php");
    }

    public function getsalesman()
    {
        $salesmanModel = Ccc::getModel('Salesman');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('salesman_id') FROM `salesman`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $salesman = $salesmanModel->fetchAll("SELECT * FROM `salesman` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        return $salesman;
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