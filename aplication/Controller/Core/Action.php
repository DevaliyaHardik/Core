<?php

class Controller_Core_Action{

    protected $message;
    protected $layout = null;
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
        return $this->getLayout()->toHtml();
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

}

?>