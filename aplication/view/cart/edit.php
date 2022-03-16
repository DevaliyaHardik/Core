<?php 
$customers = $this->getCustomers(); 
$cart = $this->getCart();
$customer = $cart->customer;
$bilingAddress = $cart->bilingAddress;
$shipingAddress = $cart->shipingAddress;
$item = $cart->item;
$products = $this->getProducts();
?>
<select onchange="change(this.value)">
	<option value="">Select</option>
	<?php foreach($customers as $cust): ?>
	<option value="<?php echo $cust->customer_id ?>"><?php echo $cust->firstName." ".$cust->email; ?></option>
	<?php endforeach; ?>
</select>
<h3>Customer Data</h3>
<table border="1">
	<tr>
		<td>First Name</td>
		<td>Last Name</td>
	</tr>
	<tr>
		<td><?php echo $customer->firstName; ?></td>
		<td><?php echo $customer->lastName; ?></td>
	</tr>
</table>
<table border="1">
	<tr>
		<th>Biling Address</th>
		<th>Shiping Address</th>
	</tr>
	<tr>
		<td>
			<table border="1">
				<tr>
					<th>Address</th>
					<th>City</th>
				</tr>
				<tr>
					<td><?php echo $bilingAddress->address; ?></td>
					<td><?php echo $bilingAddress->city; ?></td>
				</tr>
			</table>
		</td>
		<td>
			<table border="1">
				<tr>
					<th>Address</th>
					<th>City</th>
				</tr>
				<tr>
					<td><?php echo $shipingAddress->address; ?></td>
					<td><?php echo $shipingAddress->city; ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table border="1">
	<tr>
		<th>Payment Method</th>
		<th>Shiping Method</th>
	</tr>
	<tr>
		<td>
			<form action="" method="post">
				<input type="radio" name="paymentMethod" value="Credit/Debit">Credit/Debit <br>
				<input type="radio" name="paymentMethod" value="UPI">UPI <br>
				<input type="radio" name="paymentMethod" value="QR">QR <br>
				<input type="radio" name="paymentMethod" value="Case On Delivery">Case On Delivery <br>
				<input type="submit" value="Update">
			</form>
		</td>
		<td>
			<form action="" method="post">
				<input type="radio" name="shipingMethod" value="Same Day Delivery">Same Day Delivery <br>
				<input type="radio" name="shipingMethod" value="Express">Express <br>
				<input type="radio" name="shipingMethod" value="Normal Delivery">Normal Delivery <br>
				<input type="submit" value="Update">
			</form>
		</td>
	</tr>
</table>

<form action="" method="post">
	<input type="submit" value="Add Item">
	<button value="use js">Cancel</button>
	<table border="1">
		<tr>
			<th>Image</th>
			<th>Name</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Row Tatal</th>
			<th>Action</th>
		</tr>
		<?php foreach($products as $product): ?>
		<tr>
			<td><img src="Media/Product/<?php echo $product->getBase()->name; ?>" alt="image not found" width="50" hight="50"></td>
			<td><?php echo $product->name; ?></td>
			<td><input type="number" name="quantity"></td>
			<td><?php echo $product->price; ?></td>
			<td>200</td>
			<td><input type="checkbox" name="product_id" value="<?php echo $product->product_id ?>"></td>
		</tr>
		<?php endforeach; ?>
	</table>
</form>
<form action="" method="post">
		<input type="submit" value="Add Item">
		<button value="use js">New Item</button>
		<table border="1">
			<tr>
				<th>Image</th>
				<th>Name</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Row Tatal</th>
				<th>Action</th>
			</tr>
			<tr>
				<td><img src="Media/Product/<?php echo $item->getProduct()->getBase()->name; ?>" alt="image not found" width="50" hight="50"></td>
				<td><?php echo $item->name; ?></td>
				<td><input type="number" name="quantity"></td>
				<td><?php echo $item->price; ?></td>
				<td>200</td>
				<td><input type="checkbox" name="product_id" value="<?php echo $item->product_id ?>"></td>
			</tr>
		</table>
	</form>
<script type="text/javascript">
	function change(val) 
	{
		window.location = "<?php echo $this->getUrl('addCart',null,['id'=>null]);?>&id="+val;
	}
</script>