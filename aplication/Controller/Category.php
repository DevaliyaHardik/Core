<?php Ccc::loadClass("Controller_Core_Action"); ?>
<?php
class Controller_Category extends Controller_Core_Action{

	public function gridAction()
	{
		Ccc::getBlock('Category_Grid')->toHtml();
	}

    public function addAction()
	{
		Ccc::getBlock('Category_Add')->toHtml();
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
        $category = $categoryModel->fetchRow("SELECT * FROM `category` WHERE `category_id` = '$categoryId'");
        if(!$category){
            throw new Exception("Invalid request", 1);
        }
        Ccc::getBlock('Category_Edit')->addData('category',$category)->toHtml();
	}

	public function saveAction()
	{
		try {
            $request = $this->getRequest();
			if($request->isPost()){
                $row = $request->getPost('category');
				if(!$row['submit']){
					throw new Exception("Invalid Request", 1);
				}
				if($row['submit'] == 'edit'){
					$edit = Ccc::getModel('Category');
					$categoryId = $request->getRequest('id');
                    $row['updatedDate'] = date('y-m-d h:m:s');
					$result = $edit->update($row,$categoryId);
					if(!$result){
						throw new Exception("Sysetm is unable to save your data", 1);	
					}
                    $allPath = $edit->fetchAll("SELECT * FROM `category` WHERE `path` LIKE '%$categoryId%' ");
                    foreach ($allPath as $path) {

                        $finalPath = explode('/',$path['path']);
                        foreach ($finalPath as $subPath) {
                            if($subPath == $categoryId){
                                if(count($finalPath) != 1){
                                    array_shift($finalPath);
                                }    
                                break;
                            }
                            array_shift($finalPath);
                        }
                        $parentPath = $edit->fetchRow("SELECT `path` FROM `category` WHERE `category_id` = {$path['parent_id']}");    
                        $updatedPath['path'] = $parentPath['path']."/".implode('/',$finalPath);

                        $result = $edit->update($updatedPath,$path['category_id']);
                    }
                    Ccc::getBlock('Category_Grid')->toHtml();
				}
				else{
					$add = Ccc::getModel('Category');
					if(empty($row['parent_id'])){
                        unset($row['parent_id']);
                        $insertId = $add->insert($row);
                        if(!$insertId){
                            throw new Exception("system is unabel to insert your data", 1);
                        }
                        $path['path'] = $insertId;
						$result = $add->update($path,$insertId);
					}
					else{
                        $insertId = $add->insert($row);
                        if(!$insertId){
                            throw new Exception("system is unabel to insert your data", 1);
                        }
                        $parentPath = $add->fetchRow("SELECT * FROM `category` WHERE `category_id` = {$row['parent_id']}");
                        $path['path'] = $parentPath['path']."/". $insertId;
						$result = $add->update($path,$insertId);
					}
					if(!$result){
						throw new Exception("Sysetm is unable to save your data", 1);	
					}
                    Ccc::getBlock('Category_Grid')->toHtml();
				}
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function deleteAction()
	{
		try {
            $request = $this->getRequest();
			if(!$request->getRequest('id')){
				throw new Exception("Invalid Request", 1);
			}
		    $categoryId = $request->getRequest('id');
		    $delete = Ccc::getModel('Category');
		    $result = $delete->delete($categoryId);
		    if(!$result){
				throw new Exception("System is unable to delete data.", 1);
		    }
            Ccc::getBlock('Category_Grid')->toHtml();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

}

?>