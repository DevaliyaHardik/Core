<?php 
$customers = $this->getCustomers(); 
$cart = $this->getCart();
$customer = $cart->customer;
$bilingAddress = $cart->bilingAddress;
$shipingAddress = $cart->shipingAddress;
$item = $cart->item;
$items = $this->getItems();
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
<form action="<?php   echo $this->getUrl('saveCartAddress'); ?>" method="post">
	<table border="1">
		<tr>
			<th>Biling Address</th>
			<th>Shiping Address</th>
		</tr>
		<tr>
			<td>
				<table border="1">
					<tr>
						<input type="hidden" name="bilingAddress[biling]" value="1">
						<input type="hidden" name="bilingAddress[shiping]" value="2">
						<td>First Name</td>
						<td><input type="text" name="bilingAddress[firstName]" id="firstName" value="<?php echo $bilingAddress->firstName; ?>"></td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td><input type="text" name="bilingAddress[lastName]" id="lastName" value="<?php echo $bilingAddress->lastName; ?>"></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><input type="text" name="bilingAddress[address]" id="address" value="<?php echo $bilingAddress->address; ?>"></td>
					</tr>
					<tr>
						<td>City</td>
						<td><input type="text" name="bilingAddress[city]" id="city" value="<?php echo $bilingAddress->city; ?>"></td>
					</tr>
					<tr>
						<td>State</td>
						<td><input type="text" name="bilingAddress[state]" id="state" value="<?php echo $bilingAddress->state; ?>"></td>
					</tr>
					<tr>
						<td>Postal Code</td>
						<td><input type="text" name="bilingAddress[postalCode]" id="postalCode" value="<?php echo $bilingAddress->postalCode; ?>"></td>
					</tr>
					<tr>
						<td>Country</td>
						<td><input type="text" name="bilingAddress[country]" id="country" value="<?php echo $bilingAddress->country; ?>"></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="checkbox" name="sameAsShipint" id="hardik" onclick="same()">same as shiping address
							<br>
							<input type="checkbox" name="saveInBilingBook" value=1>save in address book
						</td>
					</tr>
				</table>
			</td>
			<td>
				<table border="1">
						<tr>
							<input type="hidden" name="shipingAddress[biling]" value="2">
							<input type="hidden" name="shipingAddress[shiping]" value="1">
							<td>First Name</td>
							<td><input type="text" name="shipingAddress[firstName]" id="firstName1" value="<?php echo $bilingAddress->firstName; ?>"></td>
						</tr>
						<tr>
							<td>Last Name</td>
							<td><input type="text" name="shipingAddress[lastName]" id="lastName1" value="<?php echo $bilingAddress->lastName; ?>"></td>
						</tr>
						<tr>
							<td>Address</td>
							<td><input type="text" name="shipingAddress[address]" id="address1" value="<?php echo $bilingAddress->address; ?>"></td>
						</tr>
						<tr>
							<td>City</td>
							<td><input type="text" name="shipingAddress[city]" id="city1" value="<?php echo $bilingAddress->city; ?>"></td>
						</tr>
						<tr>
							<td>State</td>
							<td><input type="text" name="shipingAddress[state]" id="state1" value="<?php echo $bilingAddress->state; ?>"></td>
						</tr>
						<tr>
							<td>Postal Code</td>
							<td><input type="text" name="shipingAddress[postalCode]" id="postalCode1" value="<?php echo $bilingAddress->postalCode; ?>"></td>
						</tr>
						<tr>
							<td>Country</td>
							<td><input type="text" name="shipingAddress[country]" id="country1" value="<?php echo $bilingAddress->country; ?>"></td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="checkbox" name="saveInShipingBook">save in address book
							</td>
						</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" value="save">
			</td>
		</tr>
	</table>
</form>
<table border="1">
	<tr>
		<th>Payment Method</th>
		<th>Shiping Method</th>
	</tr>
	<tr>
		<td>
			<form action="<?php echo $this->getUrl('savePaymentMethod') ?>" method="post">
				<input type="radio" name="paymentMethod" value="1">Credit/Debit <br>
				<input type="radio" name="paymentMethod" value="2">UPI <br>
				<input type="radio" name="paymentMethod" value="3">QR <br>
				<input type="radio" name="paymentMethod" value="4" checked>Case On Delivery <br>
				<input type="submit" value="Update">
			</form>
		</td>
		<td>
			<form action="<?php echo $this->getUrl('saveShipingMethod') ?>" method="post">
				<input type="radio" name="shipingMethod" value="100">Same Day Delivery <br>
				<input type="radio" name="shipingMethod" value="70">Express <br>
				<input type="radio" name="shipingMethod" value="50">Normal Delivery <br>
				<input type="submit" value="Update">
			</form>
		</td>
	</tr>
</table>

<form action="<?php echo $this->getUrl('addCartItem') ?>" method="post">
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
		<?php $i = 0; ?>
		<?php foreach($products as $product): ?>
		<tr>
			<td><img src="Media/Product/<?php echo $product->getBase()->name; ?>" alt="image not found" width="50" hight="50"></td>
			<td><?php echo $product->name; ?></td>
			<td><input type="number" name="cartItem[<?php echo $i ?>][quantity]"></td>
			<td><?php echo $product->price; ?></td>
			<td>200</td>
			<td><input type="checkbox" name="cartItem[<?php echo $i ?>][product_id]" value="<?php echo $product->product_id ?>"></td>
		</tr>
		<?php $i++; ?>
		<?php endforeach; ?>
	</table>
</form>
<form action="" method="post">
		<input type="submit" value="update">
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
			<?php if(!$items): ?>
			<tr>
				<td colspan="6">no item found</td>
			</tr>
			<?php else: ?>
			<?php foreach($items as $item): ?>
			<tr>
				<td><img src="Media/Product/<?php echo $item->getProduct()->getBase()->name; ?>" alt="image not found" width="50" hight="50"></td>
				<td><?php echo $item->getProduct()->name; ?></td>
				<td><input type="number" name="quantity" value="<?php echo $item->quantity; ?>"></td>
				<td><?php echo $item->getProduct()->price; ?></td>
				<td><?php echo $item->quantity * $item->getProduct()->price; ?></td>
				<td><a href="<?php echo $this->getUrl('deleteCartItem',null,['item_id' => $item->item_id]) ?>"><button>Remove</button></a></td>
			</tr>
			<?php endforeach; ?>
			<?php endif;?>
		</table>
	</form>
<script type="text/javascript">
	function change(val) 
	{
		window.location = "<?php echo $this->getUrl('addCart',null,['id'=>null]);?>&id="+val;
	}

	function same() {
					var checkedBox = document.getElementById("hardik");
					if(checkedBox.checked == true){
						var firstName = document.getElementById("firstName").value;
						var lastName = document.getElementById("lastName").value;
						var address = document.getElementById("address").value;
						var city = document.getElementById("city").value;
						var state = document.getElementById("state").value;
						var postalCode = document.getElementById("postalCode").value;
						var country = document.getElementById("country").value;

						document.getElementById("firstName1").value = firstName; 
						document.getElementById("lastName1").value = lastName; 
						document.getElementById("address1").value = address; 
						document.getElementById("city1").value = city; 
						document.getElementById("state1").value = state; 
						document.getElementById("postalCode1").value = postalCode; 
						document.getElementById("country1").value = country; 
					}
					else{
						document.getElementById("firstName1").value = null; 
						document.getElementById("lastName1").value = null; 
						document.getElementById("address1").value = null; 
						document.getElementById("city1").value = null; 
						document.getElementById("state1").value = null; 
						document.getElementById("postalCode1").value = null; 
						document.getElementById("country1").value = null; 
					}
                }

</script>