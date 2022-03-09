<?php

class Model_Core_Session{
	protected $namespace = null;

	public function __construct()
	{
		if(!$this->isStarted()){
			$this->setNamespace('core');
			session_start();
		}
		return $this;
	}
    public function start()
    {
		if(!$this->isStarted()){
			session_start();
		}
		return $this;
    }

	public function setNamespace($namespace)
	{
		$this->namespace = $namespace;
		return $this;
	}

	public function getNamespace()
	{
		return $this->namespace;
	}


	public function isStarted()
	{
		if($this->getId()){
			return true;
		}
		return false;
	}

    public function destroy()
    {
		if(!$this->isStarted()){
			$this->start();
		}
        session_destroy();
    }

    public function getId()
    {
        return session_id();
    }

    public function regenrateId()
    {
		if(!$this->isStarted()){
			$this->start();
		}
        return session_regenerate_id();
    }

    public function __set($key, $value)
	{
		if(!$this->isStarted()){
			$this->start();
		}
		$_SESSION[$this->getNamespace()][$key] = $value;
		return $this;
	}

	public function __get($key)
	{
		if(!$this->isStarted()){
			$this->start();
		}
		if (!array_key_exists($key, $_SESSION[$this->getNamespace()])) 
		{
			return null;
		}
		return $_SESSION[$this->getNamespace()][$key];
	}

	public function __unset($key)
	{
		if(!$this->isStarted()){
			$this->start();
		}
		if(array_key_exists($key, $_SESSION[$this->getNamespace()]))
		{
			unset($_SESSION[$this->getNamespace()][$key]);
		}
		return $this;
	}
}

?>