<?php 
$cart = $this->getCart();
$bilingAddress = $cart->getBilingAddress();
$shipingAddress = $cart->getShipingAddress();

?>

<div>
    <section class="content">
		<div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">Biling Address</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                            <label for="exampleInputFirstName">First Name</label>
                            <input type="text" name="bilingAddress[firstName]" value="<?php echo $bilingAddress->firstName ?>" class="form-control" id="exampleInputFirstName" placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputLastName">Last Name</label>
                            <input type="text" name="bilingAddress[lastName]" value="<?php echo $bilingAddress->lastName ?>" class="form-control" id="exampleInputLastName" placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputAddress">Address</label>
                            <input type="text" name="bilingAddress[address]" value="<?php echo $bilingAddress->address ?>" class="form-control" id="exampleInputAddress" placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputCity">City</label>
                            <input type="text" name="bilingAddress[city]" value="<?php echo $bilingAddress->city ?>" class="form-control" id="exampleInputCity" placeholder="Enter Last Name">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputState">State</label>
                            <input type="text" name="bilingAddress[state]" value="<?php echo $bilingAddress->state ?>" class="form-control" id="exampleInputState" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPosatalCode">Postal Code</label>
                            <input type="number" name="bilingAddress[postalCode]" value="<?php echo $bilingAddress->postalCode ?>" class="form-control" id="exampleInputPosatalCode" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputCountry">Country</label>
                            <input type="text" name="bilingAddress[country]" value="<?php echo $bilingAddress->country ?>" class="form-control" id="exampleInputCountry" placeholder="Enter Email">
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input custom-control-input-info" type="checkbox" id="customCheckbox4" onclick="same()">
                                <label for="customCheckbox4" class="custom-control-label">Same as Shiping Address</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input custom-control-input-info" name="saveInBilingBook" value="1" type="checkbox" id="customCheckbox5">
                                <label for="customCheckbox5" class="custom-control-label">Save to Address Book</label>
                            </div>
                        </div>
                        <div class="card-footer">
                        <input type="button" id="customerAddressSubmitBtn" class="btn btn-primary" name="submit" value="Save">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">Shiping Address</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                            <label for="exampleInputFirstName1">First Name</label>
                            <input type="text" name="shipingAddress[firstName]" value="<?php echo $shipingAddress->firstName ?>" class="form-control" id="exampleInputFirstName1" placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputLastName1">Address</label>
                            <input type="text" name="shipingAddress[lastName]" value="<?php echo $shipingAddress->lastName ?>" class="form-control" id="exampleInputLastName1" placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputAddress1">Address</label>
                            <input type="text" name="shipingAddress[address]" value="<?php echo $shipingAddress->address ?>" class="form-control" id="exampleInputAddress1" placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputCity1">City</label>
                            <input type="text" name="shipingAddress[city]" value="<?php echo $shipingAddress->city ?>" class="form-control" id="exampleInputCity1" placeholder="Enter Last Name">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputState1">State</label>
                            <input type="text" name="shipingAddress[state]" value="<?php echo $shipingAddress->state ?>" class="form-control" id="exampleInputState1" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPosatalCode1">Postal Code</label>
                            <input type="number" name="shipingAddress[postalCode]" value="<?php echo $shipingAddress->postalCode ?>" class="form-control" id="exampleInputPosatalCode1" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputCountry1">Country</label>
                            <input type="text" name="shipingAddress[country]" value="<?php echo $shipingAddress->country ?>" class="form-control" id="exampleInputCountry1" placeholder="Enter Email">
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input custom-control-input-info" name="saveInShipingBook" value="1" type="checkbox" id="customCheckbox6">
                                <label for="customCheckbox6" class="custom-control-label">Save to Address Book</label>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
		    <!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
</div>

<script>
    $("#customerAddressSubmitBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('saveCartAddress') ?>");
        admin.load();
    });

</script>
