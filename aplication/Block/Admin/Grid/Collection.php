<?php Ccc::loadClass('Block_Core_Grid_Collection');

class Block_Admin_Grid_Collection extends Block_Core_Grid_Collection   
{
    public function __construct()
    {
        parent::__construct();
        $this->setCurrentCollection('personal');
    }

    public function prepareCollections()
    {
        $adminColumn = $this->getAdmins();
        $this->addCollection([
            'title' => 'Personal Info',
            'block' => 'Admin_Grid_Collections_Personal',
            'action' => ['Edit' => ['title' => 'edit','method' => 'getEditUrl()'],
                        'Delete' => ['title' => 'delete','method' => 'getDeleteUrl()']
            ],
            'header' => ['Admin Id','Name','Email','Mobile','Password','status','Created Date','Updated Date'],
            'columns' => $adminColumn,
            'url' => $this->getUrl(null,null,['collection' => 'personal'])
        ],'personal');
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

    public function getAdmins()
    {
        $adminModel = Ccc::getModel('Admin');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('admin_id') FROM `admin`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $admins = $adminModel->fetchAll("SELECT * FROM `admin` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        $adminColumn = [];
        foreach ($admins as $admin) {
            array_push($adminColumn,$admin);
        }        

        return $adminColumn;
    }

}
