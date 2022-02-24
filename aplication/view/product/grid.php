<?php
$products = $this->getProduct();
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
    <div id="add"><a href="<?php echo $this->getUrl('product','add') ?>">Add Product</a></div>
    <div id="item">
        <table border=1 width="100%">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Base Image</th>
                <th>Thumb Image</th>
                <th>Small Image</th>
                <th>Prize</th>
                <th>Quntity</th>
                <th>Status</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Gallary</th>
            </tr>
            <?php if(!$products): ?>
            <tr><td colspan=10>No Recored Receive</td></tr>
            <?php else: ?>
            <?php foreach($products as $product): ?>
            <?php $result = ($product['status'] == 1)? 'active':'inactive'; ?> 
            <tr>
                <td><?php echo $product['product_id']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><img src="<?php echo 'Media/Product/'.$product['base']; ?>" width=50 height=50></td>
                <td><img src="<?php echo 'Media/Product/'.$product['thumb']; ?>"  width=50 height=50></td>
                <td><img src="<?php echo 'Media/Product/'.$product['small']; ?>"  width=50 height=50></td>

                <td><?php echo $product['prize']; ?></td>
                <td><?php echo $product['quntity']; ?></td>
                <td><?php echo $result; ?></td>
                <td><?php echo $product['createdDate']; ?></td>
                <td><?php echo $product['updatedDate']; ?></td>
                <td><a href='<?php echo $this->getUrl('product','edit',['id'=>$product['product_id']],true) ?>' id='edit'>Edit</a></td>
                <td><a href='<?php echo $this->getUrl('product','delete',['id'=>$product['product_id']],true) ?>' id='delete'><strong>Delete</strong></a></td>
                <td><a href="<?php echo $this->getUrl('product_media','grid',['id'=>$product['product_id']],true) ?>">Gallary</a></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>

</body>
</html>