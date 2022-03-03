<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Core_Layout_Header_Message extends Block_Core_Template{

    public function __construct()
    {
        $this->setTemplate("view/core/layout/header/message.php");
    }

    public function getMessages()
    {
        $message = Ccc::getModel('Core_Message');
        $messages = $message->getMessages();
        $message->unsetMessage();
        return $messages;
    }
}

?>