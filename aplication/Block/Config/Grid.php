<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Config_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/config/grid.php");
    }

    public function getconfig()
    {
        $configModel = Ccc::getModel('Config');
        $config = $configModel->fetchAll("SELECT * FROM `config`");
        return $config;
    }
}

?>