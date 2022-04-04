<?php

class Controller_Core_Action{

    protected $cart;
    protected $message;
    protected $layout = null;

    protected function setTitle($title)
    {
        $this->getLayout()->getHead()->setTitle($title);
    }

    public function getLayout()
    {
        if(!$this->layout){
            $this->setLayout(Ccc::getBlock('Core_Layout'));
        }
        return $this->layout;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    public function randerLayout()
    {
        $this->getResponse()
            ->setHeader('Content-type', 'text/html')
            ->render($this->getLayout()->toHtml());
    }

    public function randerContent()
    {
        $this->getResponse()
            ->setHeader('Content-type', 'text/html')
            ->render($this->getLayout()->getContent()->toHtml());
    }

    public function randerJson($content)
    {
        $this->getResponse()
            ->setHeader('Content-type', 'application/json')
            ->render(json_encode($content));
    }

    public function getAdapter()
    {
        global $Adapter;
        return $Adapter;
    }

    public function getRequest()
    {
        return Ccc::getFront()->getRequest();
    }

    public function redirect($a=null,$c=null,array $data = [],$reset = false)
    {
        $url = Ccc::getModel('Core_View')->getUrl($a,$c,$data,$reset);
        header("location: $url");
    }

    public function getMessage()
    {
        if(!$this->message){
            $this->message = Ccc::getModel('Admin_Message');
        }
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function getCart()
    {
        if(!$this->cart){
            $cart = Ccc::getModel('Admin_Cart');
            $this->setCart($cart);
        }
        return $this->cart;
    }

    public function setCart($cart)
    {
        $this->cart = $cart;
        return $this;
    }

    public function getResponse()
    {
        return Ccc::getFront()->getResponse();
    }

}

?>