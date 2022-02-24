<?php

$categories = $this->getCategory();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
</head>
<body>
    <form action="<?php echo $this->getUrl('category','save'); ?>" method="post">
        <table border="1" width="100%" cellspacing="4">
            <tr>
                <td width="10%">Subcategory</td>
                <td>
                    <select name="category[parent_id]" id="parentId">
                        <option value=<?php echo null; ?>>Root Category</option>
                    <?php foreach($categories as $category): ?>
                        <option value="<?php echo $category['category_id']; ?>"><?php echo $this->getPath($category['category_id'],$category['path']); ?></option>
                    <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="10%">Category Name</td>
                <td><input type="text" name="category[name]" id="name"></td>
            </tr>
            <tr>
                <td width="10%">Status</td>
                <td><select name="category[status]" id="status">
                    <option value="1">active</option>
                    <option value="2">inactive</option>
                </select></td>
            </tr>
            <tr>
                <td width="10%"></td>
                <td>
                    <input type="submit" value="add" name="submit">
                    <button><a href="<?php echo $this->getUrl('category','grid'); ?>">Cancel</a></button>
                </td>
            </tr>

        </table>
        
    </form>
</body>
</html>