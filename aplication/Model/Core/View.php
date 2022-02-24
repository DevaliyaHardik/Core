<?php

class Model_Core_View{
    public $template = null;
    public $data = [];

    public function setTemplate($tamplate)
    {
        $this->template = $tamplate;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function setDate(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function getData($key = null)
    {
        if(!$key){
            return $this->data;
        }
        if(array_key_exists($key,$this->data)){
            return $this->data[$key];
        }
        return null;
    }

    public function addData($key,$value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function removeData($key)
    {
        if(array_key_exists($key,$this->data)){
            unset($this->data[$key]);
        }
        return $this;
    }

    public function toHtml()
    {
        require($this->getTemplate());
    }

    public function getUrl($c=null,$a=null,array $data=null,$reset=null)
    {
        $info = [];
        if($c=null && $a=null && $data=null && $reset=null){
            $info = Ccc::getFront()->getRequest()->getRequest();
        }
        
        $info['c'] = $c==null ? Ccc::getFront()->getRequest()->getRequest('c') : $c;
        $info['a'] = $a==null ? Ccc::getFront()->getRequest()->getRequest('a') : $a;

        if($reset){
            if($data){
                $info = array_merge($info,$data);
            }
        }
        else{
            $info = array_merge(Ccc::getFront()->getRequest()->getRequest(),$info);
            if($data){
                $info = array_merge($info,$data);
            }
        }
        $url = 'index.php?'.http_build_query($info);
        return $url;
    }
}

?>