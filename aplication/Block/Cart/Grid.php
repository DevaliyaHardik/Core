<?php Ccc::loadClass("Block_Core_Template"); ?>
<?php

class Block_Cart_Grid extends Block_Core_Template
{
    protected $pager = null;
    
    public function __construct()
    {
        $this->setTemplate("view/cart/grid.php");
    }

    public function getCart()
    {
        $cartModel = Ccc::getModel('Cart');
        $request = Ccc::getModel('Core_Request');
        $this->setPager(Ccc::getModel('Core_Pager'));
        $current = $request->getRequest('p',1);
        $perPageCount = $request->getRequest('ppc',20);
        $totalCount = $this->getAdapter()->fetchOne("SELECT COUNT('cart_id') FROM `cart`");
        $this->getPager()->execute($totalCount,$current,$perPageCount);
        $cart = $cartModel->fetchAll("SELECT * FROM `cart` LIMIT {$this->getPager()->getStartLimit()},{$this->getPager()->getPerPageCount()}");
        return $cart;
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