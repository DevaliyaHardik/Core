<?php
try {
    if(!isset($_GET['product_id'])){ 
    } 
    } catch (Exception $e) {
    echo $e->getMessage();
} 
        $product_id = $_GET['product_id'];
        $fetch = new Model_Core_Adapter();
       
        $row =  $fetch->fetchRow("SELECT * FROM `product` WHERE `product_id` = $product_id");   
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD POST</title>
    <style>
    </style>
</head>

<body>
    <div id="form">
        <form action="index.php?c=product&a=save&product_id=<?php echo $product_id;?>" method="POST" enctype="multipart/form-data">
            <table border=1 width="100%" cellspacing=4>

                <tr>
                    <td width="10%">Name</td>
                    <td><input type="text" name="product[name]" value="<?php echo $row['name'];?>"></td>
                </tr>
                <tr>
                    <td width="10%">Prize</td>
                    <td><input type="float" name="product[prize]" value="<?php echo $row['prize'];?>"></td>
                </tr>
                <tr>
                    <td width="10%">Quntity</td>
                    <td><input type="number" name="product[quntity]" id="quntity" value="<?php echo $row['quntity'];?>"></td>
                </tr>
                <tr>
                    <td width="10%">Staus</td>
                    <td>
                        <select name="product[status]" id="status">
                            <?php if($row['status'] == '1'): ?>
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
                        <input type="submit" name="submit" id="submit" value="edit">
                        <button><a href="index.php?c=product&a=grid">Cancel</a></button>
                    </td>
                </tr>
            </table> 
        </form>
</body>

</html>