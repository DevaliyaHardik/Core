<?php

class Model_Core_Message{

    protected $session = null;
    const MESSAGE_SUCCESS = 1;
	const MESSAGE_WARNING = 2;
	const MESSAGE_ERROR = 3;
	const MESSAGE_DEFAULT = 1;
	const MESSAGE_SUCCESS_LBL = 'success';
	const MESSAGE_WARNING_LBL = 'warning';
	const MESSAGE_ERROR_LBL = 'error';

	public function addMessage($message,$type = null)
	{
		$types = [
			self::MESSAGE_SUCCESS => self::MESSAGE_SUCCESS_LBL,
			self::MESSAGE_WARNING => self::MESSAGE_WARNING_LBL,
			self::MESSAGE_ERROR => self::MESSAGE_ERROR_LBL,
            self::MESSAGE_DEFAULT => self::MESSAGE_SUCCESS_LBL
		];

		if(!array_key_exists($type, $types))
		{
			$type = self::MESSAGE_DEFAULT;
		}
        $type = $types[$type];

        $this->getSession()->start();
        $_SESSION['message'][$type] = $message;
	}    
    
    public function getMessages()
    {
        $this->getSession()->start();
        if(!array_key_exists('message',$_SESSION)){
            return null;
        }
        return $_SESSION['message'];
    }

    public function unsetMessage()
    {
        unset($_SESSION['message']);
    }

    public function setSession()
    {
        $this->session = Ccc::getModel('Core_Session');
    }

    public function getSession()
    {
        if(!$this->session){
            $this->setSession();
        }
        return $this->session;
    }
}

?>