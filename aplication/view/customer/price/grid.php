<?php

$products = $this->getProducts();
?>

<form action="<?php echo $this->getUrl('save','customer_price') ?>" method="post">
    <input type="submit" value="save">
    <table border="1" width="100%">
        <tr>
            <th>Product Id</th>
            <th>sku</th>
            <th>Name</th>
            <th>Price</th>
            <th>Salesman Price</th>
            <th>Coustomer Price</th>
        </tr>
        <?php if(!$products): ?>
            <tr>
                <td colspan = "7">Salesman not assign</td>
            </tr>
        <?php else: ?>
        <?php $i = 0; ?>
        <?php foreach($products as $product): ?>
        <tr>
            <input type="hidden" name="product[<?php echo $i ?>][product_id]" value="<?php echo $product->product_id; ?>">
            <input type="hidden" name="product[<?php echo $i ?>][slaesmanPrice]" value="<?php echo $this->getSalesmanPrice($product->product_id); ?>">
            <td><?php echo $product->product_id ?></td>
            <td><?php echo $product->sku ?></td>
            <td><?php echo $product->name ?></td>
            <td><?php echo $product->price ?></td>
            <td><?php echo $this->getSalesmanPrice($product->product_id); ?>
            <td><input type="text" name="product[<?php echo $i ?>][price]" value="<?php echo $this->getCustomerPrice($product->product_id) ?>"></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</form>