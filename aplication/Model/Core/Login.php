<?php

class Model_Core_Message{

    protected $session = null;

    public function __construct()
	{

	}

    public function setSession($session)
    {
		$this->session = $session;
		return $this->session;
    }

    public function getSession()
    {
        if(!$this->session){
            $this->setSession(Ccc::getModel('Core_Session'));
        }
        return $this->session;
    }

    public function login($login)
    {
        if(!$login){
            return $this;
        }
        $lodin['login'] = $login;
        $this->getSession()->$login;
        return $this;
    }

    public function logout()
    {
        if(!$this->getSession()->login){
            return null;
        }
        unset($this->getSession()->login);

        return $this;
    }

    public function getLogin()
    {
        if(!$this->getSession()->login){
            return false;
        }
        return true;        
    }
}

?>