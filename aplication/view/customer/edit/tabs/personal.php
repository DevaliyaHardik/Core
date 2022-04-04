<?php $customer = $this->getCustomer(); ?>


<section class="content">
    <div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Personal Information</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                <label for="exampleInputFirstName1">First Name</label>
                <input type="text" name="customer[firstName]" value="<?php echo $customer->firstName ?>" class="form-control" id="exampleInputFirstName1" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                <label for="exampleInputLastName1">Last Name</label>
                <input type="text" name="customer[lastName]" value="<?php echo $customer->lastName ?>" class="form-control" id="exampleInputLastName1" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="customer[email]" value="<?php echo $customer->email ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Email">
                </div>
                <div class="form-group">
                <label for="exampleInputMobile1">Mobile</label>
                <input type="text" name="customer[mobile]" value="<?php echo $customer->mobile ?>" class="form-control" id="exampleInputMobile1" placeholder="Enter Mobile">
                </div>
                <div class="row">
                <div class="col-sm-12">
                    <!-- select -->
                    <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="customer[status]">
                        <option value="1" <?php echo ($customer->getStatus($customer->status)=='Enabel')?'selected':'' ?>>Enabel</option>
                        <option value="2" <?php echo ($customer->getStatus($customer->status)=='Disabled')?'selected':'' ?>>Disabled</option>
                    </select>
                    </div>
                </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <input type="button" id="customerSubmitBtn" class="btn btn-primary" name="submit" value="save">
                <button type="button" id="customerGridBlockBtn" class="btn btn-primary" >Cancel</button>
            </div>
        </div>
        <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>


<script>
    $("#customerSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#customerGridBlockBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>