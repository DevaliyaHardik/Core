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
    <div id="add"><a href="<?php echo $this->getUrl('add','product',) ?>">Add Product</a></div>
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
            <tr><td colspan=13>No Recored Receive</td></tr>
            <?php else: ?>
            <?php foreach($products as $product): ?>
            <tr>
                <td><?php echo $product->product_id; ?></td>
                <td><?php echo $product->name; ?></td>
                <?php if($product->base ): ?>
                <td><img src="<?php echo 'Media/Product/'.$this->getMedia($product->base)['name']; ?>" alt="No Image found" width=50 height=50></td>
                <?php else: ?>
                <td>No base image</td>
                <?php endif; ?>

                <?php if($product->thumb ): ?>
                <td><img src="<?php echo 'Media/Product/'.$this->getMedia($product->thumb)['name']; ?>" alt="No Image found" width=50 height=50></td>
                <?php else: ?>
                <td>No thumb image</td>
                <?php endif; ?>

                <?php if($product->small ): ?>
                <td><img src="<?php echo 'Media/Product/'.$this->getMedia($product->small)['name']; ?>" alt="No Image found" width=50 height=50></td>
                <?php else: ?>
                <td>No small image</td>
                <?php endif; ?>

                <td><?php echo $product->prize; ?></td>
                <td><?php echo $product->quntity; ?></td>
                <td><?php echo $this->getStatus($product->status); ?></td>
                <td><?php echo $product->createdDate; ?></td>
                <td><?php echo $product->updatedDate; ?></td>
                <td><a href='<?php echo $this->getUrl('edit','product',['id'=>$product->product_id],true) ?>' id='edit'>Edit</a></td>
                <td><a href='<?php echo $this->getUrl('delete','product',['id'=>$product->product_id],true) ?>' id='delete'><strong>Delete</strong></a></td>
                <td><a href="<?php echo $this->getUrl('grid','product_media',['id'=>$product->product_id],true) ?>">Gallary</a></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>

</body>
</html>