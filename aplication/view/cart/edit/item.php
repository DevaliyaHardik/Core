<?php
$cart = $this->getCart();
$items = $cart->getItems();
$products = $this->getProducts();

?>

<div>
    <div id="productTable">
		<input type="button" id="cartItemAdd" class="btn btn-primary" name="submit" id="submit" value="Add Item">
		<button type="button" id="hideProduct" class="btn btn-primary">Cancel</button>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Image</th>
					<th>Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Row Tatal</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!$products): ?>
				<tr>
					<td colspan="8">No More products availabel</td>
				</tr>
				<?php else: ?>
				<?php $i = 0; ?>
				<?php foreach($products as $product): ?>
				<tr>
					<td><img src="<?php echo $product->getBase()->getImagePath(); ?>" alt="image not found" width="50" hight="50"></td>
					<td><?php echo $product->name; ?></td>
					<td><input type="number" name="cartProduct[<?php echo $i ?>][quantity]" value="1" min="1"></td>
					<td><?php echo $product->price; ?></td>
					<td>200</td>
					<td><input type="checkbox" name="cartProduct[<?php echo $i ?>][product_id]" value="<?php echo $product->product_id ?>"></td>
				</tr>
				<?php $i++; ?>
				<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
	<div id="cartItem">
		<input type="button" id="cartItemUpdate" class="btn btn-primary" name="submit" id="submit" value="Update">
		<button type="button" id="showProduct" class="btn btn-primary">Add Item</button>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Image</th>
					<th>Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Row Tatal</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!$items): ?>
				<tr>
					<td colspan="8">No Item Found</td>
				</tr>
				<?php else: ?>
				<?php $i = 0; ?>
				<?php foreach($items as $item): ?>
				<tr>
					<input type="hidden" name="cartItem[<?php echo $i ?>][item_id]" value="<?php echo $item->item_id ?>">
					<input type="hidden" name="cartItem[<?php echo $i ?>][product_id]" value="<?php echo $item->product_id ?>">
					<td><img src="<?php echo $item->getProduct()->getBase()->getImagePath(); ?>" alt="image not found" width="50" hight="50"></td>
					<td><?php echo $item->getProduct()->name; ?></td>
					<td><input type="number" name="cartItem[<?php echo $i ?>][quantity]" value="<?php echo $item->quantity; ?>" min="1"></td>
					<td><?php echo $item->getProduct()->price; ?></td>
					<td><?php echo $item->itemTotal; ?></td>
					<td><button type="button" class="removeCartItem btn btn-primary" value="<?php echo $item->item_id; ?>">Remove</button></td>
				</tr>
				<?php $i++; ?>
				<?php endforeach; ?>
				<?php endif; ?>
				<tr>
					<td>Total</td>
					<td colspan="5" align="right"><?php echo $this->getTotal(); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<script>
    $(document).ready(function(){
        $("#productTable").hide();
        $("#showProduct").click(function(){
            $("#productTable").show();
        });
        $("#hideProduct").click(function(){
            $("#productTable").hide();
        });

		$("#cartItemAdd").click(function(){
			admin.setForm(jQuery("#indexForm"));
			admin.setUrl("<?php echo $this->getUrl('addCartItem') ?>");
			admin.load();
		});

		$("#cartItemUpdate").click(function(){
			admin.setForm(jQuery("#indexForm"));
			admin.setUrl("<?php echo $this->getUrl('cartItemUpdate') ?>");
			admin.load();
		});

        $(".removeCartItem").click(function(){
			var data = $(this).val();
			admin.setData({'id' : data});
			admin.setUrl("<?php echo $this->getUrl('deleteCartItem') ?>");
			admin.load();
		});
    });
</script>