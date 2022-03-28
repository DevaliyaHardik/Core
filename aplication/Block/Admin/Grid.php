<?php Ccc::loadClass("Block_Core_Grid"); ?>
<?php

class Block_Admin_Grid extends Block_Core_Grid
{
    protected $pager = null;
    
    public function __construct()
    {
        parent::__construct();
    }
}

?>