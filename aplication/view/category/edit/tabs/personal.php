
<?php $categoryData = $this->getCategory(); 
$categories = $this->getCategories();
$hidden = ($categoryData->password) ? 'hidden' : 'password'; 
?>


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
            <select name="category[status]">
                    <option value="1" <?php echo ($categoryData->getStatus($categoryData->status)=='Enabel')?'selected':'' ?>>Enabel</option>
                    <option value="2" <?php echo ($categoryData->getStatus($categoryData->status)=='Disabled')?'selected':'' ?>>Disabled</option>
            </select>			
        </td>
    </tr>
    <tr>
        <td width="10%"></td>
        <td>
            <input type="submit" name="submit" value="save">
            <button><a href="<?php echo $this->getUrl('grid','category',['id' => null]); ?>">Cancel</a></button>
        </td>
    </tr>
</table> 