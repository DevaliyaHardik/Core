<?php
$cart = $this->getCart();
?>
<div>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Price Information</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Payment Method</th>
                        <th>Shiping Method</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="col-sm-6">
                                <!-- radio -->
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" value="1" type="radio" id="paymentMethod1" name="paymentMethod" checked>
                                        <label for="paymentMethod1" class="custom-control-label">Credit/Debit</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" value="2" type="radio" id="paymentMethod2" name="paymentMethod" <?php echo ($cart->paymentMethod == 2) ? "checked" : "";?>>
                                        <label for="paymentMethod2" class="custom-control-label">UPI</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" value="3" type="radio" id="paymentMethod3" name="paymentMethod" <?php echo ($cart->paymentMethod == 3) ? "checked" : "";?>>
                                        <label for="paymentMethod3" class="custom-control-label">QR</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" value="4" type="radio" id="paymentMethod4" name="paymentMethod" <?php echo ($cart->paymentMethod == 4) ? "checked" : "";?>>
                                        <label for="paymentMethod4" class="custom-control-label">Case On Delivery</label>
                                    </div>
                                    <div>
                                        <input type="button" id="cartPaymentMethodSubmitBtn" class="btn btn-primary" name="submit" value="Update">
                                    </div>
                                </div>
                            </div>

                            <!-- <form action="" method="post">
                            </form> -->
                        </td>
                        <td>
                            <div class="col-sm-6">
                                <!-- radio -->
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" value="100" type="radio" id="shipingMethod1" name="shipingMethod" checked>
                                        <label for="shipingMethod1" class="custom-control-label">Same Day Delivery-100</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" value="70" type="radio" id="shipingMethod2" name="shipingMethod" <?php echo ($cart->shipingMethod == 2) ? "checked" : "";?>>
                                        <label for="shipingMethod2" class="custom-control-label">Express-70</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" value="50" type="radio" id="shipingMethod3" name="shipingMethod" <?php echo ($cart->shipingMethod == 3) ? "checked" : "";?>>
                                        <label for="shipingMethod3" class="custom-control-label">Normal Delivery-50</label>
                                    </div>
                                    <div>
                                        <input type="button" id="cartShipingMethodSubmitBtn" class="btn btn-primary" name="submit" value="Update">
                                    </div>
                                </div>
                            </div>
                            <!-- <form action="" method="post">
                            </form> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $("#cartPaymentMethodSubmitBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('savePaymentMethod') ?>");
        admin.load();
    });

    $("#cartShipingMethodSubmitBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('saveShipingMethod') ?>");
        admin.load();
    });
</script>
