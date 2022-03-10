<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_Admin extends Controller_Admin_Action{

	public function gridAction()
	{

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$loginGrid = Ccc::getBlock('Admin_Login_Grid');
		$content->addChild($loginGrid);
		
		$this->randerLayout();
	}

}

?>