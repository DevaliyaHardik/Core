<?php
$row = $this->getProduct();
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
        <form action="<?php echo $this->getUrl('product','save',['id'=>$row['product_id']],true) ?>" method="POST" enctype="multipart/form-data">
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
                        <button><a href="<?php echo $this->getUrl('product','grid'); ?>">Cancel</a></button>
                    </td>
                </tr>
            </table> 
        </form>
</body>

</html>