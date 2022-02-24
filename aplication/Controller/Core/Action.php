<?php
Ccc::loadClass('Model_Core_View');
class Controller_Core_Action{

    protected $view = null;
    public function getView()
    {
        if(!$this->view){
            $this->setView(new Model_Core_View);
        }
        return $this->view;
    }

    public function setView($view)
    {
        $this->view = $view;
        return $this;
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

    public function redirect($url)
    {
        header("location: $url");
    }
}

?>