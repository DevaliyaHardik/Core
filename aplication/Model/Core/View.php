<?php

class Model_Core_View{
    public $template = null;
    public $data = [];
    const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';


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

    public function getStatus($key = null)
	{
		$statuses = [
			self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
			self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
		];
		if(!$key)
		{
			return $statuses;
		}

		if(array_key_exists($key, $statuses)) {
			return $statuses[$key];
		}
		return $statuses[self::STATUS_DEFAULT];
	}

}

?>