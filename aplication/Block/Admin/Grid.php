<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Admin_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/admin/grid.php");
    }

    public function getAdmin()
    {
        $adminModel = Ccc::getModel('Admin');
        $admin = $adminModel->fetchAll("SELECT * FROM `admin`");
        return $admin;
    }
}

?>