<?php 
    try {
        if(!isset($_GET['id'])){ 
            throw new Exception("Invalid Request.", 1);
        }
        $category_id = $_GET['id'];
        $fetch = new Model_Core_Adapter();
        $row =  $fetch->fetchRow("SELECT * FROM `category` WHERE `category_id` = $category_id");   
    } catch (Exception $e) {
        echo $e->getMessage();
    }
//for path
$categories = $fetch->fetchAll("SELECT * FROM `category`");
function path($categoryId,$categories){

    $len = count($categories);

    for($i = 0;$i< $len-1;$i++){

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
    <title>ADD POST</title>
</head>

<body>
    <div id="form">
        <form action="index.php?c=category&a=save&id=<?php echo $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
            <table border="1" width="100%" cellspacing="4">
                <tr>
                    <td width="10%">Subcategory</td>
                    <td>
                        <select name="category[parentId]" id="parentId">
                            <option value="<?php echo $row['category_id']; ?>"><?php echo path($row['category_id'],$categories); ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="10%">Category Name</td>
                    <td><input type="text" name="category[name]" value= "<?php echo $row['name']; ?>"> </td>
                </tr>
                <tr>
                    <td width="10%">Status</td>
                    <td>
                        <select name="category[status]" id="status">
                            <?php if($row['status'] == 1):?>
                            <option value="1" selected>active</option>
                            <option value="2">inactive</option>
                        <?php else: ?>
                            <option value="1">active</option>
                            <option value="2" selected>inactive</option>
                        <?php endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="10%"></td>
                    <td>
                        <input type="submit" name="submit" value="edit">
                        <button><a href="index.php?c=category&a=grid">Cancel</a></button>
                    </td>
                </tr>
            </table>   
        </form>
    </div>
</body>

</html>