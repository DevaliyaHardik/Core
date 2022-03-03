<?php 
$categoryData =  $this->getCategory();  
$categories = $this->getCategories();

?>
<div id="form">
    <form action="<?php echo $this->getUrl('save','category',['id'=>$categoryData->category_id],true) ?>" method="POST" enctype="multipart/form-data">
        <table border="1" width="100%" cellspacing="4">
            <tr>
                <td width="10%">Subcategory</td>
                <td>
                    <select name="category[parent_id]" id="parentId">
                        <option value="<?php echo null; ?>" <?php echo ($categoryData->parent_id == NULL) ? 'selected' : ''; ?>>Root Category</option>
                    <?php foreach($categories as $category): ?>
                        <?php if($categoryData->category_id != $category->category_id):  ?>
                        <option value="<?php echo $category->category_id; ?>" <?php echo ($categoryData->parent_id == $category->category_id) ? 'selected' : ''; ?>><?php echo $this->getPath($category->category_id,$category->path); ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="10%">Category Name</td>
                <td><input type="text" name="category[name]" value= "<?php echo $categoryData->name; ?>"> </td>
            </tr>
            <tr>
                <td width="10%">Status</td>
                <td>
                    <select name="category[status]" id="status">
                        <?php if($categoryData->status == 1):?>
                        <option value="1" selected>Enabel</option>
                        <option value="2">Disabel</option>
                    <?php else: ?>
                        <option value="1">Enabel</option>
                        <option value="2" selected>Disabel</option>
                    <?php endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="10%"></td>
                <td>
                    <input type="submit" name="submit" value="save">
                    <button><a href="<?php echo $this->getUrl('grid','category'); ?>">Cancel</a></button>
                </td>
            </tr>
        </table>   
    </form>
</div>
