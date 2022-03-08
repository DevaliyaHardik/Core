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
            <th>MRP</th>
            <th>MSP</th>
            <th>Cost</th>
            <th>Discount</th>
        </tr>
        <?php if(!$products): ?>
            <tr>
                <td colspacing = "6">No Product Found</td>
            </tr>
        <?php else: ?>
        <?php $i = 0; ?>
        <?php foreach($products as $product): ?>
        <tr>
            <input type="hidden" name="product[<?php echo $i ?>][product_id]" value="<?php echo $product->product_id; ?>">
            <input type="hidden" name="product[<?php echo $i ?>][msp]" value="<?php echo $product->minimum_support_price; ?>">
            <input type="hidden" name="product[<?php echo $i ?>][mrp]" value="<?php echo $product->price; ?>">
            <td><?php echo $product->product_id ?></td>
            <td><?php echo $product->sku ?></td>
            <td><?php echo $product->name ?></td>
            <td><?php echo $product->price ?></td>
            <td><?php echo $product->minimum_support_price ?></td>
            <td><?php echo $product->cost_price ?></td>
            <td><input type="text" name="product[<?php echo $i ?>][discount]" value="<?php echo $this->getDiscount($product->product_id) ?>"></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</form>