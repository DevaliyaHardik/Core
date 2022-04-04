<?php 
$vendor = $this->getVendor();
?> 

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
                <input type="text" name="vendor[firstName]" value="<?php echo $vendor->firstName ?>" class="form-control" id="exampleInputFirstName1" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                <label for="exampleInputLastName1">Last Name</label>
                <input type="text" name="vendor[lastName]" value="<?php echo $vendor->lastName ?>" class="form-control" id="exampleInputLastName1" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="vendor[email]" value="<?php echo $vendor->email ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Email">
                </div>
                <div class="form-group">
                <label for="exampleInputMobile1">Mobile</label>
                <input type="text" name="vendor[mobile]" value="<?php echo $vendor->mobile ?>" class="form-control" id="exampleInputMobile1" placeholder="Enter Mobile">
                </div>
                <div class="row">
                <div class="col-sm-12">
                    <!-- select -->
                    <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="vendor[status]">
                        <option value="1" <?php echo ($vendor->getStatus($vendor->status)=='Enabel')?'selected':'' ?>>Enabel</option>
                        <option value="2" <?php echo ($vendor->getStatus($vendor->status)=='Disabled')?'selected':'' ?>>Disabled</option>
                    </select>
                    </div>
                </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <input type="button" id="vendorFormSubmitBtn" class="btn btn-primary" name="submit" value="save">
                <button type="button" id="vendorGridBlockBtn" class="btn btn-primary" >Cancel</button>
            </div>
        </div>
        <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>


<script>
    $("#vendorFormSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#vendorGridBlockBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','vendor'); ?>");
        admin.load();
    });
</script>

