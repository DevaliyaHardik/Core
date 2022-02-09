<?php

$load = new Model_Core_Adapter();
$categories = $load->fetchAll("SELECT * FROM `category`");
function path($categoryId,$categories){

    $len = count($categories);

    for($i = 0;$i< $len;$i++){

        if($categoryId == $categories[$i]["category_id"]){
            if($categories[$i]["parent_id"] == null){
                return $categories[$i]["name"];
            }
            return path($categories[$i]["parent_id"],$categories)."=>".$categories[$i]["name"];
        }
    }
}
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
    <form action="index.php?c=category&a=save" method="post">
        <table border="1" width="100%" cellspacing="4">
            <tr>
                <td width="10%">Subcategory</td>
                <td>
                    <select name="category[parentId]" id="parentId">
                        <option value=<?php echo null; ?>>Root Category</option>
                    <?php foreach($categories as $category): ?>
                        <option value="<?php echo $category['category_id']; ?>"><?php echo path($category['category_id'],$categories); ?></option>
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
                    <button><a href="index.php?c=category&a=grid">Cancel</a></button>
                </td>
            </tr>

        </table>
        
    </form>
</body>
</html>