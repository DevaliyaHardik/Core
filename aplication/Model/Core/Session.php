<?php

class Model_Core_Session{

    public function start()
    {
        session_start();
    }

    public function destroy()
    {
        session_destroy();
        session_unset();
    }

    public function getId()
    {
        return session_id();
    }

    public function regenrateId()
    {
        return session_regenerate_id();
    }

    public function __set($key, $value)
	{
		$this->statSession();
		$_SESSION[$key] = $value;
		return $this;
	}

	public function __get($key)
	{
		$this->startSession();
		if (!array_key_exists($key, $_SESSION)) 
		{
			return null;
		}
		return $_SESSION[$key];
	}

	public function __unset($key)
	{
		if(array_key_exists($key, $_SESSION))
		{
			unset($_SESSION[$key]);
		}
		return $this;
	}
}

?>