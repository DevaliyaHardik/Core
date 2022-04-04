<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_Admin_Login extends Controller_Admin_Action{

	public function loginAction()
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

	public function loginPostAction()
	{
		try {
		$adminModel = Ccc::getModel("Admin");
		$loginModel = Ccc::getModel("Admin_Login");
		$request = $this->getRequest();
		if(!$request->isPost()){
			throw new Exception("invalid request", 1);
		}
		if(!$request->getPost()){
			throw new Exception("invalid request", 1);
		}
		$loginData = $request->getPost('admin');
		$password = md5($loginData['password']);
		$row = $adminModel->fetchAll("SELECT * FROM `admin` WHERE `email` = '{$loginData['email']}' AND `password` = '{$password}'");
		if(!$row){
			$this->getMessage()->addMessage("Login details incorect",Model_Core_Message::MESSAGE_ERROR);
			throw new Exception("invalid request", 1);
		}
		$loginModel->login($row[0]->email);
		$this->getMessage()->addMessage('You are Logedin');
		$this->redirect('index','product');
		} catch (Exception $e) {
			$this->redirect('login','admin_login',[],true);
		}
	}

	public function logoutAction()
	{
		$loginModel = Ccc::getModel("Admin_Login");
		if($loginModel->isLogin()){
			$loginModel->logout();
		}
		$this->redirect('login','admin_login');		
	}

}

?>