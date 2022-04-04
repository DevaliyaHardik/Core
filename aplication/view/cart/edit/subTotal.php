<?php
$cart = $this->getCart();
$items = $this->getItems();
$disabled = (!$items)?'disabled':"";
?>

<div>
<table class="table table-bordered table-striped">
		<tr>
			<td>Sub Total</td>
			<td><?php echo $this->getTotal(); ?></td>
		</tr>
		<tr>
			<td>Shiping Charge</td>
			<td><?php echo $cart->shipingCharge; ?></td>
		</tr>
		<tr>
			<td>Tax</td>
			<td><?php echo $this->getTax($cart->cart_id); ?></td>
		</tr>
		<tr>
			<td>Discount</td>
			<td><?php echo $cart->discount; ?></td>
		</tr>
		<tr>
			<td>Grand Total</td>
			<td><?php echo $this->getTotal() + $cart->shipingCharge + $this->getTax($cart->cart_id) - $cart->discount; ?></td>
			<input type="hidden" name="grandTotal" value="<?php echo $this->getTotal() + $cart->shipingCharge + $this->getTax($cart->cart_id) - $cart->discount; ?>">
			<input type="hidden" name="taxAmount" value="<?php echo $this->getTax($cart->cart_id); ?>">
			<input type="hidden" name="discount" value="<?php echo $cart->discount; ?>">
		</tr>
		<tr>
			<td></td>
			<td><input type="button" class="btn btn-primary" id="placeOrderBtn" value="Place Order" <?php echo $disabled; ?>></td>
		</tr>
	</table>
</div>

<script>
	$("#placeOrderBtn").click(function(){
		admin.setForm(jQuery("#indexForm"));
		admin.setUrl("<?php echo $this->getUrl('placeOrder') ?>");
		admin.load();
	});
</script>
