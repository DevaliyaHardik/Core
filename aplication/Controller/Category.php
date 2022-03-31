<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php
class Controller_Category extends Controller_Admin_Action{

	public function __construct()
	{
		$this->setTitle('Category');
		if(!$this->authentication()){
			$this->redirect('login','admin_login');
		}
	}

	public function gridAction()
	{
		$content = $this->getLayout()->getContent();
		$categoryGrid = Ccc::getBlock('Category_Grid');
		$content->addChild($categoryGrid);

		$this->randerLayout();
	}

    public function addAction()
	{
		$categoryModel = Ccc::getModel('Category');
		$category = $categoryModel;

		$content = $this->getLayout()->getContent();
		$categoryEdit = Ccc::getBlock('Category_Edit');
		Ccc::register('category',$category);
		$content->addChild($categoryEdit);

		$this->randerLayout();
	}

    public function editAction()
	{
		try {
			$categoryModel = Ccc::getModel('Category');
			$request = $this->getRequest();
			$categoryId = $request->getRequest('id');
			if(!$categoryId){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			if(!(int)$categoryId){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
			$category = $categoryModel->load($categoryId);
			if(!$category){
				$this->getMessage()->addMessage('Your data con not be fetch', Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("Error Processing Request", 1);			
			}
	
			$content = $this->getLayout()->getContent();
			$categoryEdit = Ccc::getBlock('Category_Edit');
			Ccc::register('category',$category);
			$content->addChild($categoryEdit);
	
			$this->randerLayout();
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('grid','customer');
		}	
	}

	public function saveAction()
	{
		try {
			$categoryModel = Ccc::getModel('Category');
            $request = $this->getRequest();
			$categoryId = $request->getRequest('id');
			if($request->isPost()){
                $postData = $request->getPost('category');
				$categoryData = $categoryModel->setData($postData);
				if(!empty($categoryId)){
					$categoryData->category_id = $categoryId;
                    $categoryData->updatedDate = date('y-m-d h:m:s');
				}
				else{
					$categoryData->createdDate = date('y-m-d h:m:s');
					if(!$categoryData->parent_id){
                        unset($categoryData->parent_id);
					}
				}
				$category = $categoryModel->save();
				if(!$category){
					throw new Exception('Your data con not be updated', 1);			
				}
				$category->savePath($categoryData);
				$this->getMessage()->addMessage('Your Data Updated Successfully');
				$this->redirect('grid',null,['id' => null]);
			}
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('grid','customer',['id' => null]);
		}	
	}

	public function deleteAction()
	{
		try {
			$categoryModel = Ccc::getModel('Category');
			$mediaModel = Ccc::getModel('Category_Media');
            $request = $this->getRequest();
			if(!$request->getRequest('id')){
				throw new Exception('Your Data can not be Deleted', 1);			
			}
		    $categoryId = $request->getRequest('id');
			
			$medias = $mediaModel->fetchAll("SELECT * FROM `category_media` WHERE `category_id` = '$categoryId'");
			foreach($medias as $media){
				unlink(Ccc::getBlock('Category_Grid')->getBaseUrl("Media/Category/"). $media->name);
			}
		    $result = $categoryModel->load($categoryId)->delete();
		    if(!$result){
				throw new Exception('Your Data can not Deleted', 1);			
		    }
			$this->getMessage()->addMessage('Your Data Delete Successfully');
			$this->redirect('grid',null,['id' => null]);
		}catch (Exception $e){
			$this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
			$this->redirect('grid','customer',['id' => null]);
		}	
	}

}

?>