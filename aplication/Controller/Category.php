<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php
class Controller_Category extends Controller_Core_Action{

	public function gridAction()
	{

		Ccc::getBlock('Category_Grid')->toHtml();

	}

    public function addAction()
	{
		$categoryModel = Ccc::getModel('Category');
		$category = $categoryModel;
		Ccc::getBlock('Category_Edit')->addData('category',$category)->toHtml();
	}

    public function editAction()
	{
        $categoryModel = Ccc::getModel('Category');
		$request = $this->getRequest();
        $categoryId = $request->getRequest('id');
        if(!$categoryId){
            throw new Exception("Invalid request", 1);
        }
        if(!(int)$categoryId){
            throw new Exception("Invalid request", 1);
        }
        $category = $categoryModel->load($categoryId);
        if(!$category){
            throw new Exception("Invalid request", 1);
        }

		Ccc::getBlock('Category_Edit')->addData('category',$category)->toHtml();
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
					if(!$postData['parent_id']){
						$categoryData->parent_id = NULL;
					}
					$result = $categoryModel->save();
					if(!$result){
						throw new Exception("Sysetm is unable to save your data", 1);	
					}
					
                    $allPath = $categoryModel->fetchAll("SELECT * FROM `category` WHERE `path` LIKE '%$categoryId%' ");
                    foreach ($allPath as $path) {
                        $finalPath = explode('/',$path->path);
                        foreach ($finalPath as $subPath) {
                            if($subPath == $categoryId){
                                if(count($finalPath) != 1){
                                    array_shift($finalPath);
                                }    
                                break;
                            }
                            array_shift($finalPath);
                        }
						if($path->parent_id){
							$parentPath = $categoryModel->load($path->parent_id);
							$path->path = $parentPath->path ."/".implode('/',$finalPath);
						}
						else{
							$path->path = $path->category_id;
						}
                        $result = $path->save();
                    }
				}
				else{
					$categoryData->createdDate = date('y-m-d h:m:s');
					if(!$categoryData->parent_id){
                        unset($categoryData->parent_id);
                        $insertId = $categoryModel->save();
                        if(!$insertId){
                            throw new Exception("system is unabel to insert your data", 1);
                        }
						$categoryData->resetData();
                        $categoryData->path = $insertId;
						$categoryData->category_id = $insertId;
						$result = $categoryModel->save();
					}
					else{
                        $insertId = $categoryModel->save();
                        if(!$insertId){
                            throw new Exception("system is unabel to insert your data", 1);
                        }
						$categoryData->category_id = $insertId;
                        $parentPath = $categoryModel->load($categoryData->parent_id);
                        $categoryData->path = $parentPath->path."/". $insertId;
						$result = $categoryData->save();
					}
					if(!$result){
						throw new Exception("Sysetm is unable to save your data", 1);	
					}
				}
				$this->redirect(Ccc::getBlock('Category_Grid')->getUrl('grid','category',[],true));
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function deleteAction()
	{
		try {
			$categoryModel = Ccc::getModel('Category');
			$mediaModel = Ccc::getModel('Category_Media');
            $request = $this->getRequest();
			if(!$request->getRequest('id')){
				throw new Exception("Invalid Request", 1);
			}
		    $categoryId = $request->getRequest('id');
			
			$medias = $mediaModel->fetchAll("SELECT * FROM `category_media` WHERE `category_id` = '$categoryId'");
			foreach($medias as $media){
				unlink(Ccc::getBlock('Category_Grid')->getBaseUrl("Media/Category/"). $media->name);
			}
		    $result = $categoryModel->load($categoryId)->delete();
		    if(!$result){
				throw new Exception("System is unable to delete data.", 1);
		    }
			$this->redirect(Ccc::getBlock('Category_Grid')->getUrl('grid','category',[],true));
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

}

?>