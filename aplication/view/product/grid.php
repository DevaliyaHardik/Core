<?php
$action = new Model_Core_Adapter();
$products = $action->fetchAll("SELECT * FROM `product`");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<style>
    body{
        text-align : center;
    }
</style>
<body>
    <h1 id="post">Products</h1>
    <div id="add"><a href="index.php?c=product&a=add">Add Product</a></div>

    <div id="item">
        <table border=1 width="100%">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Prize</th>
                <th>Quntity</th>
                <th>Status</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php if(!$products): ?>
            <tr><td colspan=9>No Recored Receive</td></tr>
            <?php else: ?>
            <?php foreach($products as $product): ?>
            <?php $result = ($product['status'] == 1)? 'active':'inactive'; ?> 
            <tr>
                <td><?php echo $product['product_id']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['prize']; ?></td>
                <td><?php echo $product['quntity']; ?></td>
                <td><?php echo $result; ?></td>
                <td><?php echo $product['createdDate']; ?></td>
                <td><?php echo $product['updatedDate']; ?></td>
                <td><a href='index.php?c=product&a=edit&product_id=<?php echo $product['product_id']; ?>' id='edit'>Edit</a></td>
                <td><a href='index.php?c=product&a=delete&product_id=<?php echo $product['product_id']; ?>' id='delete'><strong>Delete</strong></a></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>