<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Salesman extends Controller_Core_Action{

	public function gridAction()
	{
		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$message = Ccc::getBlock('Core_Layout_Header_Message');
		$header->addChild($menu)->addChild($message);

		$content = $this->getLayout()->getContent();
		$salesmanGrid = Ccc::getBlock('Salesman_Grid');
		$content->addChild($salesmanGrid);

		$this->randerLayout();
	}

	public function addAction()
	{
		$salesmanModel = Ccc::getModel("Salesman");
		$salesman = $salesmanModel;

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$header->addChild($menu);

		$content = $this->getLayout()->getContent();
		$salesmanEdit = Ccc::getBlock('Salesman_Edit')->addData('salesman',$salesman);
		$content->addChild($salesmanEdit);

		$this->randerLayout();
	}

	public function editAction()
	{
		$salesmanModel = Ccc::getModel("Salesman");
		$request = $this->getRequest();
		$salesmanId = $request->getRequest('id');
		if(!$salesmanId){
			$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
			throw new Exception("Error Processing Request", 1);			
		}
		if(!(int)$salesmanId){
			$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
			throw new Exception("Error Processing Request", 1);			
		}
		$salesman = $salesmanModel->load($salesmanId);
		if(!$salesman){
			$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
			throw new Exception("Error Processing Request", 1);			
		}

		$header = $this->getLayout()->getHeader();
		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$header->addChild($menu);

		$content = $this->getLayout()->getContent();
		$salesmanEdit = Ccc::getBlock('Salesman_Edit')->addData('salesman',$salesman);
		$content->addChild($salesmanEdit);

		$this->randerLayout();
	}

	public function saveAction()
	{		
		try {
			$request = $this->getRequest();
			$salesmanModel = Ccc::getModel('Salesman');
			$request = $this->getRequest();
			$salesmanId = $request->getRequest('id');
			if($request->isPost()){
				if(!$request->getPost()){
					$this->getMessage()->addMessage('Your data con not be inserted', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);	
				}
				$postData = $request->getPost('salesman');
				$salesmanData = $salesmanModel->setData($postData);
	
				if(!empty($salesmanId)){
					$salesmanData->salesman_id = $salesmanId;
					$salesmanData->updatedDate = date("Y-m-d h:i:s");					;
					$salesman = $salesmanModel->save();
					
					if(!$salesman){
						$this->getMessage()->addMessage('Your Data Can not updated', Model_Core_Message::MESSAGE_ERROR);
						throw new Exception("Error Processing Request", 1);
					}
					$this->getMessage()->addMessage('Your Data Updated Successfully');
				}
				else{
					$salesmanData->createdDate = date("Y-m-d h:i:s");					;
					$salesmanId = $salesmanModel->save();
	
					if(!$salesmanId){
						$this->getMessage()->addMessage('Your Data Can not saved', Model_Core_Message::MESSAGE_ERROR);
						throw new Exception("Error Processing Request", 1);
					}
					$this->getMessage()->addMessage('Your Data Saved Successfully');
				}
			}

			$this->redirect(Ccc::getBlock('Salesman_Grid')->getUrl('grid','salesman'));
			} catch (Exception $e){
				$this->redirect(Ccc::getBlock('Salesman_Grid')->getUrl('grid','salesman'));
			}
	}

	public function deleteAction()
	{
		$deleteModel = Ccc::getModel('Salesman');
		$request = $this->getRequest();
		if(!$request->isPost()){
			try {
				if(!$request->getRequest('id')){
					$this->getMessage()->addMessage('Your Data can not be Deleted', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);
				}
				$salesmanId=$request->getRequest('id');
				$result = $deleteModel->load($salesmanId)->delete();
				if(!$result){
					$this->getMessage()->addMessage('Your Data can not Saved', Model_Core_Message::MESSAGE_ERROR);
					throw new Exception("Error Processing Request", 1);
				}
				$this->getMessage()->addMessage('Your Data Saved Successfully');

				$this->redirect(Ccc::getBlock('Salesman_Grid')->getUrl('grid','salesman',[],true));

			} catch (Exception $e) {
				$this->redirect(Ccc::getBlock('Salesman_Grid')->getUrl('grid','salesman',[],true));
			}	
		}
	}

}

?>