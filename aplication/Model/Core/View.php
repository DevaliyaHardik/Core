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

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function __get($key = null)
    {
        if(array_key_exists($key,$this->data))
        {
            return $this->data[$key];
        }
        return null;
    }

    public function __unset($key)
    {
        if(array_key_exists($key,$this->data))
        {
            unset($this->data[$key]);
        }
        return $this;
    }

    public function toHtml()
    {
        ob_start();
        require($this->getTemplate());
        $html = ob_get_contents();
        ob_end_flush();
    }
    public function getUrl($a=null,$c=null,array $data = [],$reset = false)
	{

		$info = [];
		if($c==null && $a==null && $data==null && $reset==false){
			$info = Ccc::getFront()->getRequest()->getRequest();
		}
		$info['c']= $c==null ?Ccc::getFront()->getRequest()->getRequest('c') : $info['c']=$c ; 
		$info['a']= $a==null ?Ccc::getFront()->getRequest()->getRequest('a') : $info['a']=$a ; 
		if($reset){
			if($data) {
				$info = array_merge($info,$data);
			}
		}
		else{
			$info = array_merge(Ccc::getFront()->getRequest()->getRequest(),$info);
			if($data) {
				$info = array_merge($info,$data);
			}	
		}
		$url = "index.php?".http_build_query($info);
		return $url;
	}

    public function getBaseUrl($subUrl = null)
    {
        $url = "C:/php/htdocs/php/Core/aplication";
        if($subUrl){
            $url = $url."/".$subUrl;
        }
        return $url;
    }

    public function getAdapter()
	{
		$adapter = new Model_Core_Adapter();
		return $adapter;
	}
}

?>